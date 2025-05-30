<style>
.nav-container {
    background: transparent;
    padding: 0;
}

.nav-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 24px 0;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    text-decoration: none;
    color: #64748b;
    font-weight: 400;
    font-size: 15px;
    line-height: 1.5;
    transition: color 0.2s ease;
    position: relative;
    white-space: nowrap;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 18px;
    right: 18px;
    height: 1px;
    background: #3b82f6;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.2s ease;
}

.nav-link:hover {
    color: #1e293b;
}

.nav-link:hover::after {
    transform: scaleX(1);
}

.nav-link.active {
    color: #3b82f6;
    font-weight: 500;
}

.nav-link.active::after {
    transform: scaleX(1);
    background: #3b82f6;
}

/* Clean minimal icons */
.nav-link::before {
    content: '';
    width: 16px;
    height: 16px;
    background-color: currentColor;
    opacity: 0.7;
    flex-shrink: 0;
    transition: opacity 0.2s ease;
}

.nav-link:hover::before,
.nav-link.active::before {
    opacity: 1;
}


@media (max-width: 768px) {
    .nav-list {
        flex-direction: column;
        gap: 2px;
        padding: 20px 0;
        width: 100%;
    }
    
    .nav-link {
        padding: 14px 24px;
        width: 100%;
        justify-content: flex-start;
        font-size: 16px;
    }
    
    .nav-link::after {
        left: 24px;
        right: auto;
        width: 3px;
        height: 100%;
        top: 0;
        bottom: 0;
        transform-origin: top;
    }
}

@media (max-width: 480px) {
    .nav-link {
        padding: 12px 20px;
        font-size: 15px;
        gap: 12px;
    }
    
    .nav-link::before {
        width: 18px;
        height: 18px;
    }
    
    .nav-link::after {
        left: 20px;
    }
}
</style>

<div class="nav-container">
    <ul class="nav-list">
        <li class="nav-item">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clientProducts') }}" class="nav-link {{ request()->routeIs('clientProducts') ? 'active' : '' }}">Parts & Products</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clientCategory') }}" class="nav-link {{ request()->routeIs('clientCategory') ? 'active' : '' }}">Categories</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clientAbout') }}" class="nav-link {{ request()->routeIs('clientAbout') ? 'active' : '' }}">About Us</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('getMyOrders') }}" class="nav-link {{ request()->routeIs('getMyOrders') ? 'active' : '' }}">My Orders</a>
        </li>
    </ul>
</div>