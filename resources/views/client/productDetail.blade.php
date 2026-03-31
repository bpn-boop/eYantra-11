<x-template.layout title="{{ $title ?? 'Product Details' }}">
  <x-organisms.navbar :path="$shop->path ?? null"/>

  <div class="container py-4">
    <div class="ey-breadcrumb">
        <a href="{{ route('clientHome') }}">Home</a>
        <span class="sep">/</span>
        <a href="{{ route('clientProducts') }}">Products</a>
        <span class="sep">/</span>
        <a href="{{ route('clientCategoryProducts', $product->category->name ?? '') }}">{!! str_replace('-', ' ', ucwords($product->category->name ?? 'Category')) !!}</a>
        <span class="sep">/</span>
        <span class="current">{!! str_replace('-', ' ', ucwords($product->title ?? '')) !!}</span>
    </div>

    <div class="row g-5 pt-3">
        <div class="col-lg-6 col-md-12">
            <x-molecules.product-detail.product-images :dataProductimages="$product->productImage ?? []" />
        </div>
        <div class="col-lg-6 col-md-12">
            <x-molecules.product-detail.product-content :dataProductContent="$product" />
        </div>
    </div>
  </div>

  <div class="container py-5 mt-5" style="border-top: 1px solid var(--ey-border);">
    <div class="ey-section-header">
      <h2>Related <span>Parts</span></h2>
    </div>
    <div class="row g-4 mt-1">
        @forelse ($recomendationProducts ?? [] as $item)
            <div class="col-lg-3 col-md-4 col-6">
                <x-molecules.product-card :image="$item->productImage" :category="$item->category->name ?? 'General'" :title="$item->title" :price="$item->price"/>
            </div>
            @if($loop->iteration >= 4) @break @endif
        @empty
            <div class="col-12 py-4">
                <p class="ey-text-muted">No related parts available right now.</p>
            </div>
        @endforelse
    </div>
  </div>

  <x-organisms.footer :shop="$shop ?? (object)['name_shop' => 'Eyantra']"/>
</x-template.layout>