<div class="ey-product-card">
    <a href="{{ route('clientProductDetail', $title) }}" style="text-decoration: none; color: inherit; display: block; height: 100%;">
        <div class="ey-product-card-img">
            @if(isset($image) && count($image) > 0)
                @foreach ($image->take(1) as $item)
                    <img src="{{ asset('shop/products/'. $item->path) }}" alt="{{ $title }}" loading="lazy">
                @endforeach
            @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--ey-border-light);">
                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                </div>
            @endif
            <div class="ey-product-card-hover-btn">View Details</div>
        </div>
        <div class="ey-product-card-body">
            <div class="ey-product-card-cat">{!! str_replace('-', ' ', ucwords($category ?? 'General')) !!}</div>
            <div class="ey-product-card-title">{!! str_replace('-', ' ', ucwords($title)) !!}</div>
            <div class="ey-product-card-price">$ {{ $price }}</div>
        </div>
    </a>
</div>