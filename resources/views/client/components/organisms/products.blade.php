<div class="ey-section">
    <div class="container">
        {{ $slot }}
        
        <div class="row g-4">
            @forelse ($dataProduct as $item)
                <div class="col-lg-3 col-md-4 col-6">
                    <x-molecules.product-card :image="$item->productImage" :category="$item->category->name ?? 'General'" :title="$item->title" :price="$item->price"/>
                </div>
            @empty
                <div class="col-12">
                    <div class="ey-empty">
                        <i class="bi bi-box-seam ey-empty-icon"></i>
                        <h3>No Products Found</h3>
                        <p>We couldn't find any products matching your criteria.</p>
                    </div>
                </div>
            @endforelse
        </div>
        
        @if(isset($productCTA))
            <div class="text-center mt-5">
                {{ $productCTA }}
            </div>
        @endif
    </div>
</div>