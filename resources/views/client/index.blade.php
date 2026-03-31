<x-template.layout title="{{ $title ?? 'Home' }}">
  <x-organisms.navbar :path="$shop->path ?? null"/>
  
  <x-organisms.hero :dataProduct="$product ?? []"/>
  
  <x-organisms.choosen-us />

  <x-organisms.products :dataProduct="$product ?? []">
    <div class="ey-section-header">
      <h2>Recent <span>Products</span></h2>
    </div>
    <x-slot:productCTA>
      <a href="{{ route('clientProducts') }}" class="ey-btn ey-btn-outline ey-btn-lg">Explore Catalog <i class="bi bi-arrow-right ms-2"></i></a>
    </x-slot:productCTA>
  </x-organisms.products>

  {{-- Recommendations section --}}
  @if(isset($recommendedProducts) && count($recommendedProducts) > 0)
  <div style="background: var(--ey-surface-2); border-top: 1px solid var(--ey-border); padding-bottom: 2rem;">
    <x-organisms.products :dataProduct="$recommendedProducts">
      <div class="ey-section-header">
        <h2 style="font-size: 2rem;">Products You May <span style="color:var(--ey-accent);">Like</span></h2>
      </div>
    </x-organisms.products>
  </div>
  @endif

  {{-- Categories section --}}
  <div class="ey-section" style="background: var(--ey-surface); border-top: 1px solid var(--ey-border);">
      <div class="container">
          <div class="ey-section-header">
              <h2>Top <span>Categories</span></h2>
          </div>
          <div class="row g-4 mt-2">
              @foreach(($category ?? []) as $cat)
              <div class="col-md-4 col-6">
                  <a href="{{ route('clientCategoryProducts', $cat->name) }}" class="ey-card d-flex align-items-center p-4 text-decoration-none">
                      <div style="width: 48px; height: 48px; border-radius: var(--radius); background: var(--ey-surface-2); display: flex; align-items: center; justify-content: center; margin-right: 1rem; color: var(--ey-text-muted); font-size: 1.5rem;">
                          <i class="bi bi-gear"></i>
                      </div>
                      <h4 class="mb-0 text-white" style="font-size: 1.1rem; letter-spacing: 0.05em;">{!! str_replace('-', ' ', ucwords($cat->name)) !!}</h4>
                  </a>
              </div>
              @if($loop->iteration >= 6) @break @endif
              @endforeach
          </div>
          <div class="text-center mt-5">
              <a href="{{ route('clientCategory') }}" class="ey-btn ey-btn-outline">View All Categories</a>
          </div>
      </div>
  </div>

  {{-- CTA Banner --}}
  <div class="container mt-5">
      <div class="ey-cta-banner">
          <h2 class="ey-heading-md mb-3">Professional Mechanic?</h2>
          <p class="ey-text-muted mx-auto mb-4" style="max-width: 500px;">Sign up for an Eyantra Pro account to unlock bulk pricing, exclusive manufacturer parts, and priority technical support.</p>
          <a href="{{ route('signup') }}" class="ey-btn ey-btn-primary ey-btn-lg">Apply for Pro Account</a>
      </div>
  </div>

  <x-organisms.footer :shop="$shop ?? (object)['name_shop' => 'Eyantra']"/>
</x-template.layout>