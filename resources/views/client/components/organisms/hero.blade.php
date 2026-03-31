<div class="ey-hero">
  <div class="container">
    <div class="row align-items-center ey-gap-4">
      <div class="col-lg-7">
        <span class="ey-hero-eyebrow">Genuine Quality</span>
        <h1 class="ey-hero-title">Find the <span class="accent">Part.</span><br>Fix the <span class="accent">Ride.</span></h1>
        <p class="ey-hero-sub">The trusted local bike shop, digitized. Fast delivery, easy returns, and a catalog built for riders and mechanics alike.</p>
        
        <div class="ey-hero-search">
          <form action="{{ route('clientProductSearch') }}" method="GET">
            <div class="ey-search">
              <span class="ey-search-icon"><i class="bi bi-search"></i></span>
              <input type="text" name="product" class="ey-search-input" placeholder="Search by part number, name, or bike model..." style="padding-top: 1rem; padding-bottom: 1rem; font-size: 1.05rem;" required value="{{ request('product') ?? request('search') }}">
              <button type="submit" class="ey-search-btn" style="padding: 0.75rem 1.5rem; font-size: 0.95rem;">Search</button>
            </div>
          </form>
        </div>

        <div class="ey-hero-cats">
          <a href="{{ route('clientCategoryProducts', 'engine') }}" class="ey-hero-cat">Engine</a>
          <a href="{{ route('clientCategoryProducts', 'brakes') }}" class="ey-hero-cat">Brakes</a>
          <a href="{{ route('clientCategoryProducts', 'electricals') }}" class="ey-hero-cat">Electricals</a>
          <a href="{{ route('clientCategoryProducts', 'body-parts') }}" class="ey-hero-cat">Body Parts</a>
          <a href="{{ route('clientCategoryProducts', 'suspension') }}" class="ey-hero-cat">Suspension</a>
          <a href="{{ route('clientCategoryProducts', 'tyres') }}" class="ey-hero-cat">Tyres</a>
        </div>
      </div>
      
      <div class="col-lg-5 d-none d-lg-block text-center">
         {{-- Decorative graphic showcase --}}
         <div style="width: 100%; aspect-ratio: 1; background: radial-gradient(circle, rgba(255,87,34,0.15) 0%, transparent 60%); display: flex; align-items: center; justify-content: center; position: relative;">
            <i class="bi bi-tools" style="font-size: 12rem; color: var(--ey-surface-3); transform: rotate(15deg);"></i>
         </div>
      </div>
    </div>
  </div>
</div>