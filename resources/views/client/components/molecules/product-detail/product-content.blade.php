@php
  $stock = $dataProductContent->stock ?? 0;
  $title = ucwords(str_replace('-', ' ', $dataProductContent->title ?? 'Product'));
  $category = ucwords(str_replace('-', ' ', $dataProductContent->category->name ?? 'General'));
  $price = $dataProductContent->price ?? '0.00';
  $desc = $dataProductContent->desc ?? 'No description available.';
  $id = $dataProductContent->id ?? 0;
@endphp

<div class="ey-product-content">
    <div class="d-flex align-items-center gap-2 mb-2">
        <span class="ey-section-label">{{ $category }}</span>
        <span class="ey-text-dim px-1">•</span>
        <span class="ey-text-muted" style="font-family:monospace; font-size:0.8rem;">SKU: {{ rand(10000, 99999) }}-EY</span>
    </div>
    
    <h1 class="ey-heading-lg mb-3" style="font-size: 2.5rem; text-transform:none;">{{ $title }}</h1>
    
    <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom: 1px solid var(--ey-border);">
        <h2 class="ey-heading-xl m-0" style="color:var(--ey-text); text-transform:none;">${{ $price }}</h2>
        
        <div class="mt-2">
            @if($stock > 10)
                <span class="ey-badge stock-in"><i class="bi bi-check-circle-fill"></i> In Stock ({{ $stock }})</span>
            @elseif($stock > 0)
                <span class="ey-badge stock-low"><i class="bi bi-exclamation-triangle-fill"></i> Low Stock ({{ $stock }})</span>
            @else
                <span class="ey-badge stock-out"><i class="bi bi-x-circle-fill"></i> Out of Stock</span>
            @endif
        </div>
    </div>

    @if($stock > 0)
        <!-- Action Row -->
        <div class="row g-3 mb-5">
            <div class="col-sm-4 col-12">
                <label class="ey-filter-label" style="font-size:0.75rem;">Quantity</label>
                <div class="ey-qty" style="width: 100%;">
                    <button class="ey-qty-btn" onclick="eyQtyMinus()"><i class="bi bi-dash"></i></button>
                    <input type="number" id="eyCount" class="ey-qty-num" style="width: 100%; border-left: 1px solid var(--ey-border); border-right: 1px solid var(--ey-border);" value="1" min="1" max="{{ $stock }}" readonly>
                    <button class="ey-qty-btn" onclick="eyQtyPlus({{ $stock }})"><i class="bi bi-plus"></i></button>
                </div>
            </div>
            <div class="col-sm-8 col-12 d-flex align-items-end gap-2">
                <button class="ey-btn ey-btn-outline ey-btn-lg ey-btn-full" style="flex:1;">Buy Now</button>
                <button class="ey-btn ey-btn-primary ey-btn-lg ey-btn-full add-to-cart" data-id-product="{{ $id }}" data-quantity="1" style="flex:1.5;">
                    <i class="bi bi-cart-plus me-1" style="font-size:1.1rem;"></i> Add to Cart
                </button>
            </div>
        </div>
    @else
        <div class="mb-5 p-3 rounded" style="background:var(--ey-surface-2); border:1px solid var(--ey-border);">
            <p class="mb-2 text-warning"><i class="bi bi-exclamation-circle text-warning me-2"></i> This item is currently out of stock.</p>
            <p class="mb-0 ey-text-muted" style="font-size:0.875rem;">Please check back later or contact us to pre-order.</p>
        </div>
    @endif

    <!-- Tabs -->
    <div class="ey-tabs mb-4">
        <button class="ey-tab active" id="tab-desc" onclick="eySwitchTab('desc')">Description</button>
        <button class="ey-tab" id="tab-specs" onclick="eySwitchTab('specs')">Specifications</button>
        <button class="ey-tab" id="tab-returns" onclick="eySwitchTab('returns')">Shipping & Returns</button>
    </div>

    <div class="ey-tab-content" style="color:var(--ey-text-muted); line-height:1.7;">
        <div id="content-desc">
            <p style="white-space: pre-wrap;">{{ $desc }}</p>
        </div>
        <div id="content-specs" style="display:none;">
            <table class="table table-sm table-borderless" style="color:var(--ey-text-muted);">
                <tbody>
                    <tr><th style="width:140px; color:var(--ey-text);">Part Category</th><td>{{ $category }}</td></tr>
                    <tr><th style="color:var(--ey-text);">Condition</th><td>Brand New</td></tr>
                    <tr><th style="color:var(--ey-text);">Authenticity</th><td>Original Manufacturer Part</td></tr>
                    <tr><th style="color:var(--ey-text);">Warranty</th><td>6 Months EY Guarantee</td></tr>
                </tbody>
            </table>
        </div>
        <div id="content-returns" style="display:none;">
            <p><strong style="color:var(--ey-text);">Shipping:</strong> Fast dispatch within 24 hours. Delivery generally takes 2-4 business days nationwide depending on your location.</p>
            <p class="mb-0"><strong style="color:var(--ey-text);">Returns:</strong> 7 days money-back guarantee on all unused and factory-sealed parts. Electronic parts are non-refundable once opened.</p>
        </div>
    </div>
</div>

@push('js')
<script>
    // Tab switching logic
    function eySwitchTab(tabName) {
        // Reset tabs
        ['desc', 'specs', 'returns'].forEach(t => {
            document.getElementById('tab-' + t).classList.remove('active');
            document.getElementById('content-' + t).style.display = 'none';
        });
        
        // Set active
        document.getElementById('tab-' + tabName).classList.add('active');
        document.getElementById('content-' + tabName).style.display = 'block';
    }

    // Quantity stepper
    const countEl = document.getElementById("eyCount");
    const addToCartBtn = document.querySelector('.add-to-cart');
    
    function updateCartBtnQuantity(val) {
        if(addToCartBtn) addToCartBtn.setAttribute('data-quantity', val);
    }

    function eyQtyPlus(maxStock) {
        if(!countEl) return;
        let val = parseInt(countEl.value) || 1;
        if (val < maxStock) {
            val++;
            countEl.value = val;
            updateCartBtnQuantity(val);
        }
    }

    function eyQtyMinus() {
        if(!countEl) return;
        let val = parseInt(countEl.value) || 1;
        if (val > 1) {
            val--;
            countEl.value = val;
            updateCartBtnQuantity(val);
        }
    }

    // AJAX Add to Cart (preserving original functionality)
    if(addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            let product_id = this.getAttribute('data-id-product');
            let quantity = this.getAttribute('data-quantity');

            // Find meta tag specifically or use the blade csrf_token macro
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || "{{ csrf_token() }}";

            fetch('{{ route("clientAddToCart") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    _token: csrfToken,
                    product_id: product_id,
                    quantity: quantity
                })
            })
            .then(response => {
                const status = response.status;
                return response.json().then(data => ({status, data}));
            })
            .then(res => {
                const {status, data} = res;
                
                if (status === 200) {
                    // Update cart badge visually
                    const badge = document.getElementById('cartCount');
                    if(badge) {
                        badge.textContent = data.cartCount;
                        badge.style.display = 'flex';
                    }
                    
                    Toastify({
                        text: "Success! Added to Cart.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                        stopOnFocus: true,
                    }).showToast();

                    // reset counter
                    countEl.value = 1;
                    updateCartBtnQuantity(1);

                } else if (status === 201) {
                    Toastify({
                        text: "Quantity updated in Cart.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                    }).showToast();
                } else if (status === 202) {
                    Toastify({
                        text: "Max stock limit reached.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#F44336",
                    }).showToast();
                } else {
                    throw new Error('Unexpected response status');
                }
            })
            .catch(error => {
                console.error("Cart error:", error);
                Toastify({
                    text: "Error adding to cart. Please try again.",
                    duration: 3000,
                    backgroundColor: "#F44336",
                }).showToast();
            });
        });
    }
</script>
@endpush