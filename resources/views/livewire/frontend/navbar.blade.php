{{-- Navbar Haa Header Wala --}}

<div x-data="{ openDropdown: false, showMobileMenu: false }" class="header bg-[#e6faff] shadow-md">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

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
    </style>

    <!-- Top Row: Logo and Mobile Toggle -->
    <div class="flex justify-between w-full items-center">
        <div class="logo">
            <a href="#">
                <span class="logo-icon">🛍️</span> Plastic
            </a>
        </div>
        <button class="mobile-toggle" @click="showMobileMenu = !showMobileMenu">
            ☰
        </button>
    </div>

    <!-- Navigation -->
    <nav class="nav-bar" :class="{ 'show': showMobileMenu }">
        <ul>
            <li><a href="#" wire:click.prevent="changePage('home')">Home</a></li>
            <li><a href="#" wire:click.prevent="changePage('shop')">Shop</a></li>
            <li><a href="#" wire:click.prevent="changePage('sale')">Sale</a></li>
            <li><a href="#" wire:click.prevent="changePage('new')">New</a></li>
            <li><a href="#" wire:click.prevent="changePage('contact')">Contact</a></li>
        </ul>
    </nav>

    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" wire:model.debounce.500ms="searchQuery" placeholder="Search products...">
        <button wire:click="searchProducts">Search</button>
    </div>

    <!-- User + Cart Section -->
    <div class="header-actions">
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
                        <a href="#"
                            @click.prevent="
        window.location.href = '/admin-dashboard'; 
        Livewire.emit('navigate', '/admin-dashboard');
    "
                            class="text-blue-500">Dashboard</a>
                    @endif
                    {{-- <a href="{{ route('profile.edit') }}">Profile</a> --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log
                            Out</a>
                    </form>
                </div>
            </div>
        @endauth

        <!-- Cart Icon -->
        <a href="#" class="cart-icon" wire:click="openCart">
            🛒 ({{ $cartItemsCount ?? 0 }})
        </a>
    </div>
</div>
