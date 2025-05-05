{{-- Navbar PAge Change KE LIye --}}

<div class="content mt-5">
    @if ($currentPage == 'home')
        <h1>Welcome to Home Page</h1>
        <livewire:home-page />
    @elseif($currentPage == 'shop')
        <h1>Shop Our Products</h1>
        
    @elseif($currentPage == 'sale')
        <h1>Check Out Our Sale</h1>
        
    @elseif($currentPage == 'new')
        <h1>New Arrivals</h1>
        
    @elseif($currentPage == 'contact')
        <h1>Contact Us</h1>
       
    @endif
</div>
    