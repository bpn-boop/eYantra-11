@prepend('css')
<link rel="stylesheet" href="{{ asset('client/components/organisms/navbar/style.css') }}">
@endprepend

{{-- Overlay for mobile drawer --}}
<div class="ey-nav-overlay" id="navOverlay"></div>

{{-- Mobile Drawer --}}
<div class="ey-nav-drawer" id="navDrawer">
  <div class="ey-drawer-head">
    <a href="/" class="ey-nav-logo-text">EY<span>AN</span>TRA</a>
    <button class="ey-drawer-close" id="navDrawerClose" aria-label="Close menu">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>
  <div class="ey-drawer-search">
    <form action="{{ route('clientProductSearch') }}" method="GET">
      <div class="ey-search">
        <span class="ey-search-icon"><i class="bi bi-search"></i></span>
        <input type="text" name="product" class="ey-search-input" placeholder="Search parts, brands...">
      </div>
    </form>
  </div>
  <ul class="ey-drawer-links">
    <li><a href="{{ route('clientHome') }}" class="{{ request()->routeIs('clientHome') ? 'active' : '' }}">
      <i class="bi bi-house"></i> Home
    </a></li>
    <li><a href="{{ route('clientProducts') }}" class="{{ request()->routeIs('clientProducts') ? 'active' : '' }}">
      <i class="bi bi-grid-3x3-gap"></i> All Products
    </a></li>
    <li><a href="{{ route('clientCategory') }}" class="{{ request()->routeIs('clientCategory') ? 'active' : '' }}">
      <i class="bi bi-layers"></i> Categories
    </a></li>
    <li><a href="{{ route('clientAbout') }}" class="{{ request()->routeIs('clientAbout') ? 'active' : '' }}">
      <i class="bi bi-info-circle"></i> About
    </a></li>
    @auth
    <li><a href="{{ route('getMyOrders') }}" class="{{ request()->routeIs('getMyOrders') ? 'active' : '' }}">
      <i class="bi bi-bag-check"></i> My Orders
    </a></li>
    @endauth
  </ul>
  <div class="ey-drawer-footer">
    @guest
      <a href="{{ route('login') }}" class="ey-btn ey-btn-outline ey-btn-full">Login</a>
      <a href="{{ route('signup') }}" class="ey-btn ey-btn-primary ey-btn-full">Sign Up</a>
    @else
      <a href="{{ route('clientCarts') }}" class="ey-btn ey-btn-outline ey-btn-full">
        <i class="bi bi-bag"></i> Cart <span id="cartCountMobile">({{ session('cartCount', 0) }})</span>
      </a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="ey-btn ey-btn-ghost ey-btn-full" style="color:var(--ey-danger)">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    @endguest
  </div>
</div>

{{-- Main Navbar --}}
<header class="ey-nav" id="eynav">
  <div class="container">
    <div class="ey-nav-inner">

      {{-- Hamburger (mobile) --}}
      <button class="ey-nav-toggle" id="navToggle" aria-label="Open menu">
        <i class="bi bi-list"></i>
      </button>

      {{-- Logo --}}
      <a href="{{ route('clientHome') }}" class="ey-nav-logo">
        @if($path)
          <img src="{{ asset('shop/'.$path) }}" alt="Eyantra" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
          <span class="ey-nav-logo-text" style="display:none">EY<span>AN</span>TRA</span>
        @else
          <span class="ey-nav-logo-text">EY<span>AN</span>TRA</span>
        @endif
      </a>

      {{-- Desktop Nav Links --}}
      <ul class="ey-nav-links">
        <li><a href="{{ route('clientProducts') }}" class="{{ request()->routeIs('clientProducts') ? 'active' : '' }}">Products</a></li>
        <li><a href="{{ route('clientCategory') }}" class="{{ request()->routeIs('clientCategory') ? 'active' : '' }}">Categories</a></li>
        <li><a href="{{ route('clientAbout') }}" class="{{ request()->routeIs('clientAbout') ? 'active' : '' }}">About</a></li>
      </ul>

      {{-- Search bar (center, desktop) --}}
      <div class="ey-nav-search">
        <form action="{{ route('clientProductSearch') }}" method="GET">
          <div class="ey-search">
            <span class="ey-search-icon"><i class="bi bi-search"></i></span>
            <input type="text" name="product" class="ey-search-input" placeholder="Search parts, brands, models..."
              value="{{ request('product') ?? request('search') }}">
            <button type="submit" class="ey-search-btn">Go</button>
          </div>
        </form>
      </div>

      {{-- Right actions --}}
      <div class="ey-nav-actions">
        @guest
          <a href="{{ route('login') }}" class="ey-nav-action-btn" title="Login">
            <i class="bi bi-person"></i>
          </a>
        @else
          <a href="{{ route('getMyOrders') }}" class="ey-nav-action-btn" title="My Orders">
            <i class="bi bi-bag-check"></i>
          </a>
          <div class="ey-user-menu-wrapper">
            <a href="#" class="ey-nav-action-btn" title="{{ Auth::user()->name }}" id="userMenuTrigger">
              <i class="bi bi-person-circle"></i>
            </a>
            {{-- Desktop user dropdown --}}
            <div class="ey-user-dropdown" id="userDropdown">
              <div class="ey-user-dropdown-header">
                <i class="bi bi-person-circle ey-user-avatar-icon"></i>
                <div>
                  <div class="ey-user-dropdown-name">{{ Auth::user()->name }}</div>
                  <div class="ey-user-dropdown-email">{{ Auth::user()->email }}</div>
                </div>
              </div>
              <div class="ey-user-dropdown-divider"></div>
              <a href="{{ route('getMyOrders') }}" class="ey-user-dropdown-item">
                <i class="bi bi-bag-check"></i> My Orders
              </a>
              <div class="ey-user-dropdown-divider"></div>
              <form action="{{ route('logout') }}" method="POST" class="ey-user-dropdown-logout">
                @csrf
                <button type="submit" class="ey-user-dropdown-item ey-user-logout-btn">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </div>
          </div>
        @endguest

        <a href="{{ route('clientCarts') }}" class="ey-nav-action-btn" title="Cart" id="cartIcon">
          <i class="bi bi-bag"></i>
          <span class="ey-nav-badge" id="cartCount" style="{{ session('cartCount', 0) == 0 ? 'display:none' : '' }}">
            {{ session('cartCount', 0) }}
          </span>
        </a>
      </div>

    </div>
  </div>
</header>

@prepend('js')
<script>
  // Sticky shadow on scroll
  const nav = document.getElementById('eynav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 10);
  });

  // Mobile drawer
  const overlay   = document.getElementById('navOverlay');
  const drawer    = document.getElementById('navDrawer');
  const toggleBtn = document.getElementById('navToggle');
  const closeBtn  = document.getElementById('navDrawerClose');

  function openDrawer() {
    drawer.classList.add('open');
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeDrawer() {
    drawer.classList.remove('open');
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  if (toggleBtn) toggleBtn.addEventListener('click', openDrawer);
  if (closeBtn)  closeBtn.addEventListener('click', closeDrawer);
  if (overlay)   overlay.addEventListener('click', closeDrawer);

  // Keep cart count badge in sync
  function updateCartBadge(count) {
    const badge  = document.getElementById('cartCount');
    if (!badge) return;
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
  }

  // Desktop user dropdown toggle
  const userMenuTrigger = document.getElementById('userMenuTrigger');
  const userDropdown    = document.getElementById('userDropdown');

  if (userMenuTrigger && userDropdown) {
    userMenuTrigger.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      userDropdown.classList.toggle('open');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!userDropdown.contains(e.target) && !userMenuTrigger.contains(e.target)) {
        userDropdown.classList.remove('open');
      }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        userDropdown.classList.remove('open');
      }
    });
  }
</script>
@endprepend