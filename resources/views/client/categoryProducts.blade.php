<x-template.layout title="{{$title ?? 'Category'}}">
  <x-organisms.navbar :path="$shop->path ?? null"/>

  <div class="container py-4">
    <div class="ey-breadcrumb">
        <a href="{{ route('clientHome') }}">Home</a>
        <span class="sep">/</span>
        <a href="{{ route('clientCategory') }}">Categories</a>
        <span class="sep">/</span>
        <span class="current">{!! str_replace('-', ' ', ucwords($category->name ?? 'Category')) !!}</span>
    </div>

    <div class="row g-4 pt-3">
        {{-- Product Grid (Full Width) --}}
        <div class="col-12">
            <div class="ey-sort-bar">
                <h1 class="ey-heading-md m-0">{!! str_replace('-', ' ', ucwords($category->name ?? 'Category')) !!}</h1>
                <div class="ey-sort-right">
                    <span class="count d-none d-sm-inline">Showing <strong>{{ count($category->product ?? []) }}</strong> items</span>
                </div>
            </div>

            <div class="row g-4 mt-1">
                @forelse ($category->product as $item)
                    <div class="col-lg-3 col-md-4 col-6">
                        <x-molecules.product-card :image="$item->productImage" :category="$category->name" :title="$item->title" :price="$item->price"/>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="ey-empty">
                            <i class="bi bi-box-seam ey-empty-icon"></i>
                            <h3>No Parts Found</h3>
                            <p>We couldn't find any items in this category.</p>
                            <a href="{{ route('clientProducts') }}" class="ey-btn ey-btn-primary mt-3">Browse All Products</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
  </div>

  <x-organisms.footer :shop="$shop ?? (object)['name_shop' => 'Eyantra']"/>
</x-template.layout>