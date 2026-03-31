<div class="ey-gallery">
    <!-- Main Image Display -->
    <div class="ey-gallery-main">
        @if(isset($dataProductimages) && count($dataProductimages) > 0)
            <img id="eyMainImage" src="{{ asset('shop/products/'.$dataProductimages->first()->path) }}" alt="Product Image">
        @else
            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:var(--ey-surface-2); color:var(--ey-text-dim);">
                <i class="bi bi-image" style="font-size:4rem;"></i>
            </div>
        @endif
    </div>

    <!-- Thumbnail Strip -->
    @if(isset($dataProductimages) && count($dataProductimages) > 1)
        <div class="ey-gallery-thumbs mt-2">
            @foreach ($dataProductimages as $item)
                <div class="ey-gallery-thumb {{ $loop->first ? 'active' : '' }}" onclick="eySwapImage(this, '{{ asset('shop/products/'.$item->path) }}')">
                    <img src="{{ asset('shop/products/'.$item->path) }}" alt="Thumbnail">
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('js')
<script>
    function eySwapImage(el, src) {
        // Update main image source
        const mainImg = document.getElementById('eyMainImage');
        if (mainImg) {
            mainImg.src = src;
        }
        
        // Update active class on thumbnails
        const thumbs = document.querySelectorAll('.ey-gallery-thumb');
        thumbs.forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }
</script>
@endpush