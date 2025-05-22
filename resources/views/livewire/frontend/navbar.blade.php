{{-- Navbar Haa Header Wala --}}
<div>
    <!-- ICONS + THEME -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..\css\custom.css">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg  border-bottom">

        {{-- MOBILE WORK  --}}

        <div class="container-fluid px-4 px-lg-5">

            <div class="d-flex d-lg-none justify-content-between align-items-center w-100 mb-2">
                <!-- Mobile Logo -->
                <div>
                    <a class="navbar-brand d-inline-block" href="#">
                        <img height="100" width="100" style="object-fit: cover;"
                            src="data:image/jpeg;base64,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"
                            alt="Logo">
                    </a>
                </div>

                <!-- Right-side: Search & Toggle together -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Search Icon -->
                    <button class="btn p-0 border-0 bg-transparent" style="margin-right: 10px" type="button"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="bi bi-search fs-5"></i>
                    </button>

                    <!-- Toggler -->
                    <button class="btn p-0 border-0 bg-transparent" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Cart & Auth -->
            <div class="d-flex d-lg-none justify-content-between align-items-center px-3 mb-3 w-100"
                style="max-width: 100%;">
                @auth
                    <!-- Cart Button (Left) -->
                    <a href="{{ route('cart.index') }}" class="position-relative">
                        <i class="bi bi-cart-fill fs-5 text-dark"></i>
                    </a>

                    <!-- User Dropdown (Center) -->
                    <x-dropdown align="center" width="48">
                        <x-slot name="trigger">
                            <button
                                class="btn btn-light d-flex align-items-center shadow-sm border rounded-pill px-3 py-1 mx-auto">
                                <span class="me-2 text-dark fw-semibold">
                                    {{ \Illuminate\Support\Str::limit(Auth::user()->name, 10) }}
                                </span>
                                <svg class="fill-current text-secondary" width="16" height="16" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="dropdown-menu show p-2 shadow border-0 rounded-3 mt-2"
                                style="min-width: 10rem; background-color: #f8f9fa;">
                                @if (Auth::check() && Auth::user()->role === '1')
                                    <a href="/admin-dashboard"
                                        class="dropdown-item d-flex align-items-center text-dark fw-medium px-3 py-2 rounded-2 hover-bg">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                                    </a>
                                @endif

                                <x-dropdown-link :href="route('profile.edit')"
                                    class="dropdown-item d-flex align-items-center text-dark fw-medium px-3 py-2 rounded-2 hover-bg">
                                    <i class="bi bi-person me-2"></i> {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="dropdown-item d-flex align-items-center text-dark fw-medium px-3 py-2 rounded-2 hover-bg">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>

                    <!-- My Orders Button (Right) -->
                    <a href="/my-orders" class="position-relative">
                        <i class="bi bi-bag-check-fill fs-5 text-dark"></i>
                    </a>
                @else
                    <!-- Mobile Login Icon -->
                    <a href="/login" class="btn btn-outline-secondary d-flex align-items-center" title="Login"
                        style="margin-left: 20px">
                        <i class="bi bi-person-circle fs-4 me-1"></i>
                        <span class="d-none d-sm-inline">Login</span>
                    </a>

                    <!-- Mobile Register Icon -->
                    <a href="/register" class="btn btn-outline-primary d-flex align-items-center" title="Register">
                        <i class="bi bi-box-arrow-in-right fs-4 me-1"></i>
                        <span class="d-none d-sm-inline">Register</span>
                    </a>
                @endauth
            </div>




            <!--Mobile Search Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Search</h5>
                            <button type="button" style="background-color: white" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input class="form-control" type="search" placeholder="Search for products..."
                                    aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Brand -->
            <a class="navbar-brand fw-bold fs-3 d-none d-lg-block" href="#">
                <img height="125px"
                    src="data:image/jpeg;base64,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"
                    alt="Logo">
            </a>

            <!-- Desktop COLLAPSIBLE MENU -->

            <div class="collapse navbar-collapse mt-lg-0" id="navbarSupportedContent">
                <!-- Desktop Search and Links -->
                <div class="d-none d-lg-flex flex-column align-items-center w-50 mx-auto">
                    <!-- NAVIGATION MENU -->
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold px-2" href="/">Home</a>
                        </li>

                        <li class="nav-item dropdown position-relative text-center">
                            <!-- Category dropdown remains unchanged -->
                            <a class="nav-link text-dark fw-semibold px-2 d-flex justify-content-center align-items-center dropdown-hover"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Category
                                <i class="bi bi-chevron-down ms-1"></i>
                            </a>

                            <ul class="dropdown-menu p-4 shadow-lg category-dropdown"
                                aria-labelledby="navbarDropdown">
                                <div class="category-grid">
                                    @foreach ($categories as $category)
                                        <div class="category-cell">
                                            <a class="category-link"
                                                href="#category-{{ $category->id }}">{{ $category->name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </ul>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold px-2" href="#" id="productsLink"
                                wire:click.prevent="changePage('products')">Products</a>
                        </li> --}}

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const productsLink = document.getElementById('productsLink');
                                if (productsLink) {
                                    productsLink.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        const currentURL = window.location.href;
                                        if (currentURL.includes('/product') || currentURL.includes('/view')) {
                                            window.history.back();
                                        } else {
                                            @this.changePage('products');
                                        }
                                    });
                                }

                                const homeLink = document.getElementById('homeLink');
                                if (homeLink) {
                                    homeLink.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        const currentURL = window.location.href;
                                        if (currentURL.includes('/product') || currentURL.includes('/view')) {
                                            window.history.back();
                                        } else {
                                            @this.changePage('home');
                                        }
                                    });
                                }

                                const aboutLink = document.getElementById('aboutLink');
                                if (aboutLink) {
                                    aboutLink.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        const currentURL = window.location.href;
                                        if (currentURL.includes('/product') || currentURL.includes('/view')) {
                                            window.history.back();
                                        } else {
                                            @this.changePage('about');
                                        }
                                    });
                                }

                                const contactLink = document.getElementById('contactLink');
                                if (contactLink) {
                                    contactLink.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        const currentURL = window.location.href;
                                        if (currentURL.includes('/product') || currentURL.includes('/view')) {
                                            window.history.back();
                                        } else {
                                            @this.changePage('contact');
                                        }
                                    });
                                }
                            });
                        </script>

                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold px-2" href="/about">About</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold px-2" href="/contact">Contact</a>
                        </li>

                    </ul>

                    <!-- SEARCH BAR BELOW NAVIGATION -->
                    <form action="{{ route('search.results') }}" class="w-100" id="mainSearchForm" method="GET">
                        <div class="input-group">
                            <input type="search" name="query" class="form-control border-dark text-dark bg-white"
                                placeholder="Search for products..." aria-label="Search"
                                value="{{ request('query') }}">
                            <button class="btn btn-outline-dark" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Existing nav links (productsLink, homeLink, etc.)...

                        const searchForm = document.getElementById('mainSearchForm');
                        if (searchForm) {
                            searchForm.addEventListener('submit', function(e) {
                                const currentURL = window.location.href;
                                if (currentURL.includes('/product') || currentURL.includes('/view')) {
                                    e.preventDefault();
                                    window.history.back();
                                }
                                // Otherwise, allow normal search behavior
                            });
                        }
                    });
                </script>
                {{-- </div> --}}

                {{-- <!-- Mobile Nav Links --> --}}
                <!-- Mobile Nav Links -->
                <ul class="navbar-nav d-lg-none ms-auto px-3">
                    <!-- Home Link -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="/">
                            <i class="fas fa-home me-2"></i> Home
                        </a>
                    </li>

                    <!-- Category Dropdown -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" id="mobileHomeLink">
                            <i class="fas fa-th-large me-2"></i>
                            Category
                            <i class="bi bi-chevron-down ms-1"></i>
                        </a>
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="#category-{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <!-- About Link -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="/about">
                            <i class="fas fa-info-circle me-2"></i> About
                        </a>
                    </li>

                    <!-- Contact Link -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="/contact">
                            <i class="fas fa-envelope me-2"></i> Contact
                        </a>
                    </li>
                </ul>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const mobileLinks = [{
                                id: 'mobileHomeLink',
                                page: 'home'
                            },
                            {
                                id: 'mobileAboutLink',
                                page: 'about'
                            },
                            {
                                id: 'mobileContactLink',
                                page: 'contact'
                            }
                        ];

                        mobileLinks.forEach(link => {
                            const el = document.getElementById(link.id);
                            if (el) {
                                el.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    const currentURL = window.location.href;
                                    if (currentURL.includes('/product') || currentURL.includes('/view')) {
                                        window.history.back();
                                    } else {
                                        @this.changePage(link.page);
                                    }
                                });
                            }
                        });
                    });
                </script>
                {{-- <ul class="navbar-nav d-lg-none ms-auto px-3">
                    <!-- Home Link -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="#" wire:click.prevent="changePage('home')">
                            <i class="fas fa-home me-2"></i> Home
                        </a>
                    </li>

                    <!-- Category Dropdown -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-th-large me-2"></i>
                            Category
                            <i class="bi bi-chevron-down ms-1"></i>
                        </a>
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="#category-{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <!-- Products Link -->
                    {{-- <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="#" wire:click.prevent="changePage('products')">
                            <i class="fas fa-cogs me-2"></i> Products
                        </a>
                    </li> --}}

                {{-- <!-- About Link -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="#" wire:click.prevent="changePage('about')">
                            <i class="fas fa-info-circle me-2"></i> About
                        </a>
                    </li>

                    <!-- Contact Link -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center px-3 py-2 rounded shadow-sm bg-light text-dark fw-semibold hover-bg"
                            href="#" wire:click.prevent="changePage('contact')">
                            <i class="fas fa-envelope me-2"></i> Contact
                        </a>
                    </li> --}}
                {{-- </ul> --}}
            </div>

        </div>

        <!-- Desktop Right Icons (Cart, Login, Register) -->
        <div class="d-none d-lg-flex align-items-center ms-lg-auto mt-1 mt-lg-0">
            @auth

                <!-- Authenticated User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="btn btn-light d-flex align-items-center shadow-sm border rounded-pill px-3 py-1 me-3">
                            <span class="me-2 text-dark fw-semibold text-truncate d-inline-block"
                                style="max-width: 120px;">
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="text-secondary" width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="dropdown-menu show p-2 shadow border-0 rounded-3 mt-2"
                            style="min-width: 12rem; background-color: #f8f9fa;">
                            @if (Auth::user()->role === '1')
                                <a href="/admin-dashboard"
                                    class="dropdown-item text-dark fw-medium px-3 py-2 rounded-2 hover-bg d-flex align-items-center">
                                    <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                                </a>
                            @endif

                            <x-dropdown-link :href="route('profile.edit')"
                                class="dropdown-item text-dark fw-medium px-3 py-2 rounded-2 hover-bg d-flex align-items-center">
                                <i class="bi bi-person me-2"></i> {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="dropdown-item text-dark fw-medium px-3 py-2 rounded-2 hover-bg d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right me-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                <!-- Cart Button (Only after login) -->
                <a href="{{ route('cart.index') }}" class=" position-relative me-3">
                    <i class="bi bi-cart-fill me-1 fs-5"></i>
                    {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark"
                        id="cart-count">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span> --}}
                </a>
                <a href="/my-orders" class=" d-flex align-items-center gap-2 px-3 py-2 rounded-pill position-relative"
                    style="margin-right: 20px">
                    <i class="bi bi-bag-check-fill fs-5"></i>
                </a>
            @else
                <!-- Desktop Login Icon -->
                <a href="/login" class="btn btn-outline-secondary me-2 d-flex align-items-center" title="Login">
                    <i class="bi bi-person-circle fs-4 me-1"></i>
                    <span class="d-none d-xl-inline">Login</span>
                </a>

                <!-- Desktop Register Icon -->
                <a href="/register" class="btn btn-outline-primary d-flex align-items-center" title="Register">
                    <i class="bi bi-box-arrow-in-right fs-4 me-1"></i>
                    <span class="d-none d-xl-inline">Register</span>
                </a>
            @endauth
        </div>
    </nav>
    <style>
        .btn-outline-dark:hover {
            background-color: #212529;
            color: #fff;
            transition: all 0.3s ease;
        }
    </style>

</div>



{{-- <div x-data="{ openDropdown: false, showMobileMenu: false }" class="header bg-[#e6faff] shadow-md"> --}}
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
{{-- 
    <style>
        .header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            border-bottom: 1px solid #cce7f6;
            font-family: 'Inter', sans-serif;
        }

        .logo a {
            font-size: 2rem;
            font-weight: 800;
            color: #0ea5e9;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo-icon {
            font-size: 1.8rem;
            margin-right: 8px;
        }

        .nav-bar {
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-bar ul {
            display: flex;
            gap: 30px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-bar a {
            font-size: 1rem;
            font-weight: 500;
            color: #0369a1;
            text-decoration: none;
            position: relative;
            padding: 4px 0;
        }

        .nav-bar a::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #0ea5e9;
            transition: width 0.3s;
        }

        .nav-bar a:hover::after {
            width: 100%;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-bar input {
            padding: 8px 12px;
            border: 1px solid #bde0f5;
            border-radius: 6px;
            font-size: 0.95rem;
            width: 200px;
        }

        .search-bar input:focus {
            border-color: #0ea5e9;
            outline: none;
        }

        .search-bar button {
            padding: 8px 14px;
            background: #0ea5e9;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .search-bar button:hover {
            background: #0284c7;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
        }

        .dropdown-button {
            background: none;
            border: none;
            font-size: 1rem;
            color: #0369a1;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dropdown-button:hover {
            color: #0ea5e9;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-top: 8px;
            min-width: 180px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            z-index: 999;
            padding: 10px 0;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu a:hover {
            background: #f8f8f8;
            color: #0ea5e9;
        }

        .cart-icon {
            font-size: 1.3rem;
            text-decoration: none;
            color: #0369a1;
        }

        .cart-icon:hover {
            color: #0ea5e9;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.6rem;
            cursor: pointer;
            color: #0ea5e9;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: stretch;
                padding: 15px 20px;
                gap: 12px;
            }

            .mobile-toggle {
                display: block;
                align-self: flex-end;
            }

            .nav-bar {
                width: 100%;
                display: none;
            }

            .nav-bar.show {
                display: flex;
                flex-direction: column;
                margin-top: 10px;
                gap: 10px;
            }

            .nav-bar ul {
                flex-direction: column;
                gap: 10px;
            }

            .search-bar {
                flex-direction: column;
                width: 100%;
            }

            .search-bar input {
                width: 100%;
            }

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style> --}}

<!-- Top Row: Logo and Mobile Toggle -->
{{-- <div class="flex justify-between w-full items-center">
        <div class="logo">
            <a href="#">
                <span class="logo-icon">🛍️</span> Plastic
            </a>
        </div>
        <button class="mobile-toggle" @click="showMobileMenu = !showMobileMenu">
            ☰
        </button>
    </div> --}}

<!-- Navigation -->
{{-- <nav class="nav-bar" :class="{ 'show': showMobileMenu }">
        <ul>
            <li><a href="#" wire:click.prevent="changePage('home')">Home</a></li>
            <li><a href="#" wire:click.prevent="changePage('shop')">Shop</a></li>
            <li><a href="#" wire:click.prevent="changePage('sale')">Sale</a></li>
            <li><a href="#" wire:click.prevent="changePage('new')">New</a></li>
            <li><a href="#" wire:click.prevent="changePage('contact')">Contact</a></li>
        </ul>
    </nav> --}}

<!-- Search Bar -->
{{-- <div class="search-bar">
        <input type="text" wire:model.debounce.500ms="searchQuery" placeholder="Search products...">
        <button wire:click="searchProducts">Search</button>
    </div> --}}

<!-- User + Cart Section -->
{{-- <div class="header-actions">
        @auth
            <div @click.away="openDropdown = false" class="relative">
                <button class="dropdown-button" @click="openDropdown = !openDropdown">
                    {{ Auth::user()->name }}
                    <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openDropdown" class="dropdown-menu" x-transition>
                    <a href="#"
                        @click.prevent="
        window.location.href = '{{ route('profile.edit') }}'; 
        Livewire.emit('navigate', '{{ route('profile.edit') }}');
    "
                        class="text-blue-500">Profile</a>

                    @if (Auth::check() && Auth::user()->role === '1')
                        {{-- <a href="/admin-dashboard">Admin Dashboard</a> --}}
{{-- <a href="#"
                            @click.prevent="
        window.location.href = '/admin-dashboard'; 
        Livewire.emit('navigate', '/admin-dashboard');
    "
                            class="text-blue-500">Dashboard</a>
                    @endif
                    {{-- <a href="{{ route('profile.edit') }}">Profile</a> --}}
{{-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log
                            Out</a>
                    </form>
                </div>
            </div>
        @endauth --}}

<!-- Cart Icon -->
{{-- <a href="#" class="cart-icon" wire:click="openCart">
            🛒 ({{ $cartItemsCount ?? 0 }})
        </a>
    </div>
</div> --}}
