<x-template.layout title="{{$title ?? 'Search Results'}}">
  <x-organisms.navbar :path="$shop->path ?? null"/>

  <div class="container py-4">
    <div class="ey-breadcrumb">
        <a href="{{ route('clientHome') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">Search Results</span>
    </div>

    {{-- Large Search Bar --}}
    <div class="mb-4">
        <form action="{{ route('clientProductSearch') }}" method="GET">
            <div class="ey-search">
              <span class="ey-search-icon" style="font-size: 1.25rem; left: 1rem;"><i class="bi bi-search"></i></span>
              <input type="text" name="product" class="ey-search-input" placeholder="Search entire catalog..." style="padding-top: 1rem; padding-bottom: 1rem; padding-left: 3.25rem; font-size: 1.05rem;" value="{{ request('product') ?? $search ?? '' }}">
              <button type="submit" class="ey-search-btn" style="padding: 0.75rem 1.5rem; font-size: 0.95rem;">Search</button>
            </div>
        </form>
    </div>

    <div class="row g-4 pt-2">
        {{-- Product Grid (Full Width) --}}
        <div class="col-12">
            <div class="ey-sort-bar">
                <h1 class="ey-heading-md m-0">Search: <span style="color:var(--ey-text-muted)">"{{ $search ?? request('product') }}"</span></h1>
                <div class="ey-sort-right">
                    <span class="count d-none d-sm-inline">Found <strong>{{ method_exists($product, 'total') ? $product->total() : count($product ?? []) }}</strong> items</span>
                </div>
            </div>

            <div class="row g-4 mt-1">
                @forelse ($product ?? [] as $item)
                    <div class="col-lg-3 col-md-4 col-6">
                        <x-molecules.product-card :image="$item->productImage" :category="$item->category->name ?? 'General'" :title="$item->title" :price="$item->price"/>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="ey-empty">
                            <i class="bi bi-search ey-empty-icon" style="font-size: 4rem;"></i>
                            <h3>No Results Found</h3>
                            <p>We couldn't find anything matching "{{ $search ?? request('product') }}". Try different keywords or part numbers.</p>
                            <a href="{{ route('clientProducts') }}" class="ey-btn ey-btn-primary mt-3">Browse All Products</a>
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