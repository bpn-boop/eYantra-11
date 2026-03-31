<footer class="ey-footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <a href="/" class="ey-nav-logo-text mb-3 d-inline-block" style="font-size: 2rem;">EY<span>AN</span>TRA</a>
                <p class="mb-4 pe-md-4">{{ $shop->desc ?? 'The trusted local bike shop, digitized. Supplying genuine parts for riders and mechanics everywhere.' }}</p>
                <div class="d-flex align-items-center gap-3">
                    <a href="#" class="ey-btn-ghost" style="padding:0; font-size: 1.25rem;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="ey-btn-ghost" style="padding:0; font-size: 1.25rem;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="ey-btn-ghost" style="padding:0; font-size: 1.25rem;"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-3 col-6">
                <h6>Company</h6>
                <a href="{{ route('clientAbout') }}" class="d-block">About Us</a>
                <a href="{{ route('clientProducts') }}" class="d-block">All Products</a>
                <a href="{{ route('clientCategory') }}" class="d-block">Categories</a>
            </div>
            
            <div class="col-lg-2 col-md-3 col-6">
                <h6>Support</h6>
                <a href="#" class="d-block">Contact Us</a>
                <a href="#" class="d-block">FAQ</a>
                <a href="#" class="d-block">Shipping Info</a>
                <a href="#" class="d-block">Returns Policy</a>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <h6>Contact Detail</h6>
                <div class="d-flex align-items-start gap-3 mb-3">
                    <i class="bi bi-geo-alt mt-1 text-muted"></i>
                    <p class="mb-0">Kathmandu, Nepal<br>10400 Ring Road</p>
                </div>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <i class="bi bi-envelope text-muted"></i>
                    <p class="mb-0">hello@eyantra.com</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-telephone text-muted"></i>
                    <p class="mb-0">{{ $shop->phone ?? '+977 980 0000000' }}</p>
                </div>
            </div>
        </div>
        
        <div class="ey-footer-bottom">
            <p class="mb-0">&copy; {{ now()->year }} {{ $shop->name_shop ?? 'Eyantra' }}. All rights reserved.</p>
        </div>
    </div>
</footer>