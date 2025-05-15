{{-- Ye Admin Page Change Kerta Hai --}}

<div class="p-4 sm:p-6 md:p-10 bg-white rounded-lg shadow w-full max-w-full overflow-x-auto">
    @if ($page === 'dashboard')
        <livewire:admin-controller />
    @elseif ($page === 'category')
        <livewire:Admin.category-page />
    @elseif ($page === 'product')
        <livewire:Admin.product-page />
    @elseif ($page === 'orders')
        <h2 class="text-lg sm:text-xl font-semibold text-gray-700">🧾 Orders Overview</h2>
    @elseif ($page === 'users')
        <h2 class="text-lg sm:text-xl font-semibold text-gray-700">👥 User Directory</h2>
    @endif
</div>
