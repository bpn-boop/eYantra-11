<div class="search-actions-container">
    <!-- Enhanced Search Form -->
    <form action="{{ route('clientProductSearch') }}" class="search-form" method="GET">
        <div class="search-input-wrapper">
            <i class="bi search-icon"></i>
            <input 
                class="search-input" 
                type="search" 
                placeholder="Search" 
                id="searchInput" 
                name="product" 
                onfocus="Onfocus(this)" 
                onblur="Onblur(this)"
                autocomplete="off"
            >
            <button class="search-submit-btn" type="submit" aria-label="Search">
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>
        
        <!-- Search Suggestions (Optional) -->
        <!-- <div class="search-suggestions" id="searchSuggestions" style="display: none;">
            <div class="suggestion-item">
                <i class="bi bi-clock-history"></i>
                <span>Recent: Brake Pads</span>
            </div>
            <div class="suggestion-item">
                <i class="bi bi-fire"></i>
                <span>Popular: Engine Oil</span>
            </div>
            <div class="suggestion-item">
                <i class="bi bi-lightning"></i>
                <span>Trending: LED Headlights</span>
            </div>
        </div> -->
    </form>

    <!-- User Actions -->
    <div class="user-actions">
        <!-- Cart -->
        <a href="{{ route('clientCarts') }}" class="action-btn cart-btn">
            <i class="bi bi-bag"></i>
            <span class="action-badge" id="cartCount">{{ count((array) session('cart')) }}</span>
            <span class="action-tooltip">Cart</span>
        </a>

        <!-- Wishlist (Optional) -->
        <div class="action-btn wishlist-btn">
            <i class="bi bi-heart"></i>
            <span class="action-badge">0</span>
            <span class="action-tooltip">Wishlist</span>
        </div>

        <!-- User Account -->
        @if (auth()->check() && auth()->user()->role == 'user')
        <div class="user-dropdown">
            <button class="user-avatar-btn" type="button" id="userDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar">
                    <span>{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow"></i>
            </button>

            <ul class="dropdown-menu user-dropdown-menu shadow" aria-labelledby="userDropdownBtn">
                <li class="user-info">
                    <div class="user-avatar-large">
                        <span>{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </div>
                    <div class="user-details">
                        <h6>{{ auth()->user()->name }}</h6>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                </li>
                
                <li><hr class="dropdown-divider"></li>
                
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalUpdateProfile">
                        <i class="bi bi-person"></i>
                        Edit Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalUpdatePassword">
                        <i class="bi bi-lock"></i>
                        Change Password
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('clientCarts') }}">
                        <i class="bi bi-bag"></i>
                        My Orders
                    </a>
                </li>
                
                <li><hr class="dropdown-divider"></li>
                
                <li>
                    <a href="{{ route('logout') }}" 
                       class="dropdown-item logout-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        Log Out
                    </a>
                </li>
            </ul>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        @elseif (auth()->check() && auth()->user()->role == 'admin')
        <a href="{{ url('/home') }}" class="action-btn admin-btn">
            <i class="bi bi-speedometer2"></i>
            <span class="action-text">Dashboard</span>
        </a>

        @else
        <a href="{{ url('/login') }}" class="action-btn login-btn">
            <i class="bi bi-person"></i>
            <span class="action-text">Login</span>
        </a>
        @endif
    </div>
</div>

<style>
.search-actions-container {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
}

/* Enhanced Search Form */
.search-form {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.search-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 30px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    overflow: hidden;
}

.search-input-wrapper:focus-within {
    border-color: #ff5733;
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 20px rgba(255, 87, 51, 0.3);
    transform: scale(1.02);
}

.search-icon {
    position: absolute;
    left: 1rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.1rem;
    z-index: 2;
    transition: color 0.3s ease;
}

.search-input-wrapper:focus-within .search-icon {
    color: #ff5733;
}

.search-input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 0.8rem 3.5rem 0.8rem 3rem;
    color: #fff;
    font-size: 0.95rem;
    outline: none;
    width: 100%;
    transition: all 0.3s ease;
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
    transition: color 0.3s ease;
}

.search-input:focus::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

.search-submit-btn {
    position: absolute;
    right: 0.5rem;
    background: linear-gradient(45deg, #ff5733, #ffa500);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.search-submit-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(255, 87, 51, 0.4);
}

/* Search Suggestions */
.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    margin-top: 0.5rem;
    overflow: hidden;
    border: 1px solid rgba(255, 87, 51, 0.2);
}

.suggestion-item {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
    gap: 0.5rem;
}

.suggestion-item:hover {
    background: linear-gradient(90deg, #ff5733, #ffa500);
    color: #fff;
    transform: translateX(5px);
}

.suggestion-item i {
    font-size: 0.9rem;
    opacity: 0.7;
}

/* User Actions */
.user-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.action-btn {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    color: #fff;
    text-decoration: none;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    cursor: pointer;
    backdrop-filter: blur(10px);
}

.action-btn:hover {
    color: #fff;
    background: rgba(255, 255, 255, 0.2);
    border-color: #ff5733;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 87, 51, 0.3);
}

.action-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(45deg, #ff5733, #ffa500);
    color: #fff;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: bold;
    animation: pulse 2s infinite;
    border: 2px solid #fff;
}

.action-tooltip {
    position: absolute;
    bottom: -35px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    font-size: 0.8rem;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.action-btn:hover .action-tooltip {
    opacity: 1;
    visibility: visible;
}

.action-text {
    font-size: 0.9rem;
    font-weight: 500;
}

/* User Dropdown */
.user-dropdown {
    position: relative;
}

.user-avatar-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 0.4rem 1rem 0.4rem 0.4rem;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.user-avatar-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: #ff5733;
    transform: translateY(-2px);
}

.user-avatar {
    width: 35px;
    height: 35px;
    background: linear-gradient(45deg, #ff5733, #ffa500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
    color: #fff;
}

.dropdown-arrow {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.user-avatar-btn[aria-expanded="true"] .dropdown-arrow {
    transform: rotate(180deg);
}

.user-dropdown-menu {
    min-width: 280px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    padding: 0;
    margin-top: 0.5rem;
    background: #fff;
    overflow: hidden;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #1a1a2e, #16213e);
    color: #fff;
    margin: 0;
}

.user-avatar-large {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #ff5733, #ffa500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: bold;
    color: #fff;
}

.user-details h6 {
    margin: 0;
    font-weight: 600;
    font-size: 1rem;
}

.user-details p {
    margin: 0;
    font-size: 0.85rem;
    opacity: 0.8;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0.8rem 1.5rem;
    color: #333;
    transition: all 0.3s ease;
    border: none;
}

.dropdown-item:hover {
    background: linear-gradient(90deg, rgba(255, 87, 51, 0.1), rgba(255, 165, 0, 0.1));
    color: #ff5733;
    transform: translateX(5px);
}

.dropdown-item i {
    font-size: 1rem;
    width: 20px;
}

.logout-item:hover {
    background: linear-gradient(90deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.1));
    color: #dc3545;
}

.admin-btn, .login-btn {
    background: linear-gradient(45deg, #ff5733, #ffa500);
    border-color: transparent;
    font-weight: 600;
}

.admin-btn:hover, .login-btn:hover {
    background: linear-gradient(45deg, #e84e2f, #e6940a);
    transform: translateY(-2px) scale(1.05);
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Mobile Responsive */
@media screen and (max-width: 768px) {
    .search-actions-container {
        flex-direction: column;
        gap: 1rem;
        width: 100%;
    }

    .search-form {
        max-width: 100%;
        width: 100%;
    }

    .search-input {
        font-size: 0.9rem;
    }

    .user-actions {
        justify-content: center;
        flex-wrap: wrap;
    }

    .action-text {
        display: none;
    }

    .action-btn {
        padding: 0.6rem;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        justify-content: center;
    }

    .user-avatar-btn {
        padding: 0.4rem;
        border-radius: 50%;
    }

    .user-dropdown-menu {
        min-width: 250px;
        right: 0;
        left: auto;
    }
}

@media screen and (max-width: 480px) {
    .search-input::placeholder {
        font-size: 0.85rem;
    }
    
    .user-actions {
        gap: 0.5rem;
    }
    
    .action-btn {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}
</style>

<script>
// Enhanced search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    
    // Show/hide suggestions
    searchInput.addEventListener('focus', function() {
        if (this.value.trim() === '') {
            searchSuggestions.style.display = 'block';
        }
    });
    
    searchInput.addEventListener('blur', function() {
        // Delay hiding to allow clicking on suggestions
        setTimeout(() => {
            searchSuggestions.style.display = 'none';
        }, 200);
    });
    
    // Handle suggestion clicks
    document.querySelectorAll('.suggestion-item').forEach(item => {
        item.addEventListener('click', function() {
            const text = this.querySelector('span').textContent.split(': ')[1];
            searchInput.value = text;
            searchSuggestions.style.display = 'none';
            searchInput.form.submit();
        });
    });
    
    // Enhanced search on enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const searchTerm = this.value.trim();
            if (searchTerm) {
                this.form.submit();
            }
        }
    });
    
    // Auto-hide suggestions when typing
    searchInput.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            searchSuggestions.style.display = 'none';
        } else {
            searchSuggestions.style.display = 'block';
        }
    });
});

// Update cart count dynamically (if needed)
function updateCartCount(count) {
    document.getElementById('cartCount').textContent = count;
}
</script>