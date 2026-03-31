<x-template.layout title="{{ $title ?? 'About Eyantra' }}">
  <x-organisms.navbar :path="$shop->path ?? null"/>

  {{-- Hero Section --}}
  <div class="ey-section" style="background: linear-gradient(to bottom, var(--ey-surface), var(--ey-bg)); border-bottom: 1px solid var(--ey-border);">
    <div class="container text-center py-5">
      <h1 class="ey-heading-xl mb-4" style="color:var(--ey-accent);">We Keep You Riding.</h1>
      <p class="ey-text-muted mx-auto" style="max-width: 600px; font-size: 1.1rem; line-height: 1.8;">
        Founded with the mission to supply genuine, high-quality parts to riders and mechanics anywhere. Whether you're rebuilding an engine or doing routine maintenance, Eyantra provides the parts you trust.
      </p>
    </div>
  </div>

  {{-- Stats Row --}}
  <div class="container" style="margin-top: -3rem;">
    <div class="row g-4">
      <div class="col-lg-3 col-6">
        <div class="ey-stat">
          <span class="ey-stat-num">{{ now()->year - 2018 }}</span>
          <span class="ey-stat-label">Years Operating</span>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="ey-stat">
          <span class="ey-stat-num">12k+</span>
          <span class="ey-stat-label">Parts Cataloged</span>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="ey-stat">
          <span class="ey-stat-num">24h</span>
          <span class="ey-stat-label">Fast Dispatch</span>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="ey-stat">
          <span class="ey-stat-num">98%</span>
          <span class="ey-stat-label">Satisfaction</span>
        </div>
      </div>
    </div>
  </div>

  {{-- Mission & Story --}}
  <div class="ey-section container mt-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div style="background: var(--ey-surface-2); border-radius: var(--radius-lg); aspect-ratio: 4/3; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background: radial-gradient(circle at 30% 70%, rgba(255,87,34,0.1) 0%, transparent 60%);"></div>
            <i class="bi bi-gear-wide-connected" style="font-size: 8rem; color: var(--ey-border-light); opacity: 0.5;"></i>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="ey-section-header">
          <h2>Our <span>Mission</span></h2>
        </div>
        <div class="ey-text-muted" style="line-height: 1.8;">
          <p>Eyantra isn't just a store; it's a commitment to the riding community. We noticed a major problem: finding genuine parts was too difficult. Mechanics were waiting weeks for imports, and riders were settling for counterfeit components.</p>
          <p>We built this platform to digitize the local bike shop experience. By working directly with <strong>OEM manufacturers</strong> and authorized distributors, we skip the middleman delays.</p>
          <p>Our promise is simple: If we stock it, it's genuine. If you order it, it arrives fast. No fluff, just parts.</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Commitments --}}
  <div class="ey-section" style="background: var(--ey-surface); border-top: 1px solid var(--ey-border);">
    <div class="container">
      <div class="ey-section-header justify-content-center text-center">
        <h2>The Eyantra <span>Commitment</span></h2>
      </div>
      
      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="p-4 rounded text-center h-100" style="background: var(--ey-bg); border: 1px solid var(--ey-border);">
            <i class="bi bi-shield-check" style="font-size: 2.5rem; color: var(--ey-accent); margin-bottom: 1rem; display: block;"></i>
            <h4 class="mb-3">100% Genuine</h4>
            <p class="ey-text-muted mb-0">Every part we sell is sourced through official channels. We do not tolerate counterfeits or B-grade components.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 rounded text-center h-100" style="background: var(--ey-bg); border: 1px solid var(--ey-border);">
            <i class="bi bi-headset" style="font-size: 2.5rem; color: var(--ey-accent); margin-bottom: 1rem; display: block;"></i>
            <h4 class="mb-3">Expert Support</h4>
            <p class="ey-text-muted mb-0">Unsure about compatibility? Our support team consists of experienced mechanics ready to help you find precisely what you need.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 rounded text-center h-100" style="background: var(--ey-bg); border: 1px solid var(--ey-border);">
            <i class="bi bi-arrow-clockwise" style="font-size: 2.5rem; color: var(--ey-accent); margin-bottom: 1rem; display: block;"></i>
            <h4 class="mb-3">Hassle-Free Returns</h4>
            <p class="ey-text-muted mb-0">Mistakes happen. If a part doesn't fit within 7 days and remains unused, send it back for a full refund. Simple and fair.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-organisms.footer :shop="$shop ?? (object)['name_shop' => 'Eyantra']"/>
</x-template.layout>