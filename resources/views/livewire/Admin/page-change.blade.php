{{-- Ye Admin Page Change Kerta Hai --}}

<div class="p-4 sm:p-6 md:p-10 bg-white rounded-lg shadow w-full max-w-full overflow-x-auto">
    @if ($page === 'dashboard')
        <livewire:admin-controller />
    @elseif ($page === 'category')
        <livewire:Admin.category-page />
    @elseif ($page === 'product')
        <livewire:Admin.product-page />
    @elseif ($page === 'slide')
        <livewire:Admin.slider-page />
    @elseif ($page === 'orders')
        <livewire:Admin.order-page />
    @elseif ($page === 'users')
        <livewire:Admin.user-page />
    @endif
</div>
