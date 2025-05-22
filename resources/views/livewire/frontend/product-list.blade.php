{{-- Navbar PAge Change KE LIye --}}

<div>
    @if ($currentPage == 'home')
        {{-- <h1>Welcome to Home Page</h1> --}}
        <livewire:home-page />
    @elseif($currentPage == 'products')
        <livewire:product-page />
    @elseif($currentPage == 'view')
        <livewire:product-view /> <!-- No need to pass any productId here -->
    @elseif($currentPage == 'about')
        <livewire:product-about />
    @elseif($currentPage == 'contact')
        <livewire:product-contact />
    @endif
</div>
