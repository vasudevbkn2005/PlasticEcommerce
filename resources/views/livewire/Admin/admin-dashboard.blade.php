{{-- Ye Admin Panel Ka Side Vala hai --}}

<div x-data="{ open: false }" class="flex h-screen bg-gray-100">
        <!-- Mobile hamburger -->
        <div class="md:hidden p-4">
            <button @click="open = !open">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <aside  :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-md transform transition-transform duration-200 ease-in-out md:translate-x-0 z-50">
            <div class="p-6 font-bold text-xl border-b">Admin Panel</div>
            <nav class="mt-6 space-y-1">
                <a href="#" wire:click="changePage('dashboard')" @click="open = false"  class="flex items-center gap-2 px-4 py-2 text-gray-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-600 transition">📊 Dashboard</a>
                <a href="#" wire:click="changePage('category')" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-gray-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-600 transition">🗂️ Category</a>
                <a href="#" wire:click="changePage('product')" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-gray-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-600 transition">📦 Product</a>
                <a href="#" wire:click="changePage('orders')" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-gray-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-600 transition">🧾 Orders</a>
                <a href="#" wire:click="changePage('users')" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-gray-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-600 transition">👥 Users</a>
                <a href="/dashboard" wire:click="changePage('users')" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-gray-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-600 transition">🏠 Home</a>
            </nav>
        </aside>

        <!-- Page Content -->
        <main class="flex-1 ml-0 md:ml-64 p-6">
            <livewire:page-change />
        </main>
    </div>

    <!-- Alpine.js CDN -->
    <script src=\"https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js\" defer></script>
