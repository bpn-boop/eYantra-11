@prepend('css')
<link rel="stylesheet" href="{{ asset('client/components/organisms/navbar/style.css') }}">
@endprepend

<header class="header" id="header">
    <nav class="nav container">
        <div class="nav-button">
            <div class="nav-toggle" id="nav-toggle">
                <i class="bi bi-list"></i>
            </div>
        </div>
        
        <a href="/" class="nav-logo" id="logo">
            <img src="{{ asset('shop/'.$path) }}" alt="logo">
        </a>
        
        <div class="nav-menu" id="nav-menu">
            <x-molecules.navbar.menu />
            <div class="nav-close" id="nav-close">
                <i class="bi bi-x"></i>
            </div>
        </div>
        
        <div class="icon-left">
            <div class="search-container">
                <i class="bi bi-search search-icon"></i>
                <x-molecules.navbar.search-bar/>
            </div>
        </div>
    </nav>
</header>

@prepend('js')
<script>
const navMenu = document.getElementById("nav-menu"),
      navToggle = document.getElementById("nav-toggle"),
      navClose = document.getElementById("nav-close"),
      logo = document.getElementById("logo");

// Mobile menu toggle
if (navToggle) {
    navToggle.addEventListener("click", () => {
        navMenu.classList.add("show-menu");
        document.body.style.overflow = 'hidden';
    });
}

if (navClose) {
    navClose.addEventListener("click", () => {
        navMenu.classList.remove("show-menu");
        document.body.style.overflow = 'auto';
    });
}

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (!navMenu.contains(e.target) && !navToggle.contains(e.target)) {
        navMenu.classList.remove("show-menu");
        document.body.style.overflow = 'auto';
    }
});


function Onblur() {
    if (window.matchMedia("(min-width:767px)").matches) {
        navMenu.classList.remove("d-none");
    } else {
        logo.classList.remove("d-none");
    }
}


// Search functionality (if your search-bar component doesn't handle this)
const searchInput = document.querySelector('.search-bar input');
if (searchInput) {
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const searchTerm = e.target.value.trim();
            if (searchTerm) {
                // Add your search logic here
                window.location.href = `/search?q=${encodeURIComponent(searchTerm)}`;
            }
        }
    });
}
</script>

<style>
@keyframes slideDown {
    from { transform: translateY(-100%); }
    to { transform: translateY(0); }
}
</style>
@endprepend