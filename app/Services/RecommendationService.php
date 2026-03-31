<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductView;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    /**
     * Get a list of recommended products for the current user or guest session.
     * 
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecommendations($limit = 4)
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        $interactedCategoryIds = [];

        // 1. Extract categories from recently viewed products
        $viewQuery = ProductView::select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10);
            
        if ($userId) {
            $viewQuery->where('user_id', $userId);
        } else {
            $viewQuery->where('session_id', $sessionId);
        }

        $viewedProductIds = $viewQuery->pluck('product_id')->toArray();
        $viewedProducts = Product::whereIn('id', $viewedProductIds)->get();
        foreach ($viewedProducts as $prod) {
            $interactedCategoryIds[] = $prod->category_id;
        }

        // 2. Extract categories from purchased products (Logged in only)
        $orderedProductIds = [];
        if ($userId) {
            $orders = Order::where('user_id', $userId)->pluck('id');
            if ($orders->count() > 0) {
                // OrderDetail saves 'title' instead of product_id, map it back
                $orderedTitles = OrderDetail::whereIn('order_id', $orders)->pluck('title')->toArray();
                $orderedProducts = Product::whereIn('title', $orderedTitles)->get();
                foreach ($orderedProducts as $prod) {
                    $interactedCategoryIds[] = $prod->category_id;
                    $orderedProductIds[] = $prod->id;
                }
            }
        }

        $interactedCategoryIds = array_unique($interactedCategoryIds);
        // Products they've already seen or bought
        $excludeProductIds = array_unique(array_merge($viewedProductIds, $orderedProductIds));

        // 3. Primary Engine: Recommend unseen items from engaged categories
        if (!empty($interactedCategoryIds)) {
            $recommendations = Product::whereIn('category_id', $interactedCategoryIds)
                ->whereNotIn('id', $excludeProductIds)
                ->inRandomOrder() // Mix it up for freshness
                ->limit($limit)
                ->get();
                
            // If we found enough relevant products, return them immediately
            if ($recommendations->count() > 0) {
                // If it couldn't fill $limit, we still return what it found to keep it strictly relevant
                return $recommendations;
            }
        }

        // 4. Fallback #1: Most Globally Viewed Context
        $mostViewedProductIds = ProductView::select('product_id', DB::raw('COUNT(*) as total_views'))
            ->groupBy('product_id')
            ->orderByDesc('total_views')
            ->limit($limit)
            ->pluck('product_id')
            ->toArray();

        // 5. Fallback #2: Best Selling (Most frequent string titles in order details)
        $bestSellingTitles = OrderDetail::select('title', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('title')
            ->orderByDesc('total_sales')
            ->limit($limit)
            ->pluck('title')
            ->toArray();

        // Blend fallback sources if standard recommendations fail
        $fallbackProductIds = [];
        
        if (!empty($mostViewedProductIds)) {
            $fallbackProductIds = array_merge($fallbackProductIds, $mostViewedProductIds);
        }

        if (!empty($bestSellingTitles)) {
            $bestSellers = Product::whereIn('title', $bestSellingTitles)->select('id')->pluck('id')->toArray();
            $fallbackProductIds = array_merge($fallbackProductIds, $bestSellers);
        }

        if (!empty($fallbackProductIds)) {
            $fallbackProductIds = array_unique($fallbackProductIds);
            return Product::whereIn('id', $fallbackProductIds)->take($limit)->get();
        }

        // Absolute Zero State: Nothing ordered or viewed site-wide ever.
        return Product::inRandomOrder()->limit($limit)->get();
    }
}
