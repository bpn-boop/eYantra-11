<x-template.layout title="{{$title ?? 'Products'}}">
  <x-organisms.navbar :path="$shop->path ?? null"/>

  <div class="container py-4">
    <div class="ey-breadcrumb">
        <a href="{{ route('clientHome') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">All Products</span>
    </div>

    {{-- Large Search Bar --}}
    <div class="mb-4">
        <form action="{{ route('clientProductSearch') }}" method="GET">
            <div class="ey-search">
              <span class="ey-search-icon" style="font-size: 1.25rem; left: 1rem;"><i class="bi bi-search"></i></span>
              <input type="text" name="product" class="ey-search-input" placeholder="Search entire catalog..." style="padding-top: 1rem; padding-bottom: 1rem; padding-left: 3.25rem; font-size: 1.05rem;" value="{{ request('product') }}">
              <button type="submit" class="ey-search-btn" style="padding: 0.75rem 1.5rem; font-size: 0.95rem;">Search</button>
            </div>
        </form>
    </div>

    <div class="row g-4 pt-2">
        {{-- Product Grid (Full Width) --}}
        <div class="col-12">
            <div class="ey-sort-bar">
                <span class="count d-none d-sm-inline">Showing <strong>{{ count($product ?? []) }}</strong> items</span>
            </div>

            <div class="row g-4 mt-1">
                @forelse ($product ?? [] as $item)
                    <div class="col-lg-3 col-md-4 col-6">
                        <x-molecules.product-card :image="$item->productImage" :category="$item->category->name ?? 'General'" :title="$item->title" :price="$item->price"/>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="ey-empty">
                            <i class="bi bi-box-seam ey-empty-icon"></i>
                            <h3>No Products Found</h3>
                            <p>We couldn't find any products in your catalog.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="pt-5 d-flex justify-content-center">
                {{ method_exists($product, 'links') ? $product->links('vendor.pagination.bootstrap-5') : '' }}
            </div>
        </div>
    </div>
  </div>

  <x-organisms.footer :shop="$shop ?? (object)['name_shop' => 'Eyantra']"/>
</x-template.layout>