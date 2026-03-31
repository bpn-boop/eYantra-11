<x-template.layout title="My Orders" >  
  <x-organisms.navbar path="/orders"/>

  <div class="container py-5">
    <div class="ey-breadcrumb">
        <a href="{{ route('clientHome') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">My Accounts</span>
        <span class="sep">/</span>
        <span class="current">My Orders</span>
    </div>

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4 mt-3">
        <h1 class="ey-heading-lg mb-0">My Orders</h1>
        <div class="ey-status-tabs" id="orderTabs">
            <span class="ey-status-tab active" data-filter="all">All</span>
            <span class="ey-status-tab" data-filter="0">Unprocessed</span>
            <span class="ey-status-tab" data-filter="1">Confirmed</span>
            <span class="ey-status-tab" data-filter="2">Processed</span>
            <span class="ey-status-tab" data-filter="3">Pending</span>
            <span class="ey-status-tab" data-filter="4">Shipping</span>
            <span class="ey-status-tab" data-filter="5">Completed</span>
        </div>
    </div>

    @if(count($orders) > 0)
        <!-- Order List (Card Layout) -->
        <div class="row" id="orderList">
            <div class="col-12">
                @foreach ($orders as $order)
                <div class="ey-order-card" data-status="{{ $order->status }}">
                    <!-- Header (Click to expand) -->
                    <div class="ey-order-header" onclick="this.classList.toggle('open'); this.nextElementSibling.classList.toggle('show');">
                        <div>
                            <div class="ey-order-id">Order #{{ strtoupper(substr($order->id ?? 'EY'.rand(1000,9999), 0, 8)) }}</div>
                            <div class="ey-order-date">Placed on {{ $order->created_at ? $order->created_at->format('M d, Y') : now()->format('M d, Y') }}</div>
                        </div>
                        
                        <div class="ey-order-meta">
                            <div class="ey-order-total">${{ number_format($order->total, 2) }}</div>
                            <div>
                                @if($order->status == 0)
                                    <span class="ey-badge ey-badge-warning">Unprocessed</span>
                                @elseif($order->status == 1)
                                    <span class="ey-badge ey-badge-info">Confirmed</span>
                                @elseif($order->status == 2)
                                    <span class="ey-badge ey-badge-accent">Processed</span>
                                @elseif($order->status == 3)
                                    <span class="ey-badge ey-badge-danger">Pending</span>
                                @elseif($order->status == 4)
                                    <span class="ey-badge ey-badge-info"><i class="bi bi-truck me-1"></i> Shipping</span>
                                @elseif($order->status == 5)
                                    <span class="ey-badge ey-badge-success"><i class="bi bi-check2-all me-1"></i> Completed</span>
                                @elseif($order->status == 6)
                                    <span class="ey-badge ey-badge-muted">Failed</span>
                                @endif
                            </div>
                            <i class="bi bi-chevron-down ey-order-chevron"></i>
                        </div>
                    </div>

                    <!-- Expandable Body -->
                    <div class="ey-order-body">
                        <div class="row g-4">
                            <!-- Items -->
                            <div class="col-md-7">
                                <h6 class="ey-text-muted mb-3" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Items</h6>
                                <div class="ey-order-item">
                                    <div class="ey-order-thumb">
                                        <i class="bi bi-box" style="font-size: 1.5rem; display: flex; align-items: center; justify-content: center; height: 100%; color: var(--ey-text-dim);"></i>
                                    </div>
                                    <div class="ey-order-item-info">
                                        <div class="ey-order-item-name">{{ $order->orderDetail->title ?? 'Product Title' }}</div>
                                        <div class="ey-order-item-qty">Qty: {{ $order->orderDetail->quantity ?? 1 }}</div>
                                    </div>
                                    <div class="ey-order-total">${{ number_format($order->total, 2) }}</div>
                                </div>
                            </div>
                            
                            <!-- Tracking & Address -->
                            <div class="col-md-5">
                                <div class="p-4 rounded h-100" style="background: var(--ey-surface-2); border: 1px solid var(--ey-border);">
                                    <h6 class="ey-text-muted mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Shipping Info</h6>
                                    <p class="mb-3" style="font-size: 0.9rem; line-height: 1.4;">{{ $order->address }}</p>
                                    
                                    @if($order->note)
                                        <h6 class="ey-text-muted mb-2" style="font-size: 0.8rem; text-transform: uppercase;">Order Note</h6>
                                        <p class="mb-3" style="font-size: 0.9rem; line-height: 1.4; color: var(--ey-text-dim);">"{{ $order->note }}"</p>
                                    @endif
                                    
                                    @if($order->status == 4 || $order->status == 5)
                                        <div class="mt-4 pt-3" style="border-top: 1px solid var(--ey-border);">
                                            <a href="#" class="ey-btn ey-btn-outline ey-btn-sm ey-btn-full"><i class="bi bi-truck"></i> Track Package</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12" id="noFiltersMatch" style="display: none;">
                <div class="text-center py-5 ey-text-muted border rounded" style="background: var(--ey-surface); border-color: var(--ey-border) !important;">
                    <i class="bi bi-funnel" style="font-size: 2rem; opacity: 0.5;"></i>
                    <p class="mt-3">No orders match this status filter.</p>
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="ey-empty py-5 mt-5 border rounded" style="background: var(--ey-surface); border-color: var(--ey-border) !important;">
            <i class="bi bi-receipt ey-empty-icon text-muted" style="opacity: 0.3;"></i>
            <h3>No Orders Yet</h3>
            <p>You haven't placed any orders. Start exploring our catalog to find what you need.</p>
            <a href="{{ route('clientProducts') }}" class="ey-btn ey-btn-primary mt-3">Shop Parts</a>
        </div>
    @endif
  </div>

  <x-organisms.footer :shop="$shop ?? (object)['name_shop' => 'Eyantra']"/>
  
  @push('js')
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const tabs = document.querySelectorAll('#orderTabs .ey-status-tab');
          const cards = document.querySelectorAll('.ey-order-card');
          const noMatchMsg = document.getElementById('noFiltersMatch');

          tabs.forEach(tab => {
              tab.addEventListener('click', function() {
                  // Update active tab styling
                  tabs.forEach(t => t.classList.remove('active'));
                  this.classList.add('active');

                  const filterType = this.getAttribute('data-filter');
                  let visibleCount = 0;

                  cards.forEach(card => {
                      const status = parseInt(card.getAttribute('data-status'), 10);
                      let shouldShow = false;

                      if (filterType === 'all') {
                          shouldShow = true;
                      } else {
                          shouldShow = (status === parseInt(filterType, 10));
                      }

                      card.style.display = shouldShow ? 'block' : 'none';
                      if (shouldShow) visibleCount++;
                  });

                  if(noMatchMsg) {
                      noMatchMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
                  }
              });
          });
      });
  </script>
  @endpush
</x-template.layout>