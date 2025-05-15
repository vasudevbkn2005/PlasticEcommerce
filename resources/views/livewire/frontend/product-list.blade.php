{{-- Navbar PAge Change KE LIye --}}

<div class="content mt-5">
    @if ($currentPage == 'home')
        {{-- <h1>Welcome to Home Page</h1> --}}
        <livewire:home-page />
    @elseif($currentPage == 'products')
        <livewire:product-page />
    @elseif($currentPage == 'view')
        <livewire:product-view /> <!-- No need to pass any productId here -->
    @elseif($currentPage == 'about')
        <h1>About Page</h1>
    @elseif($currentPage == 'new')
        <h1>New Arrivals</h1>
    @elseif($currentPage == 'contact')
        <h1>Contact Us</h1>
    @endif
</div>

