{{-- Ye Waala Admin Dashboard Desing Hai --}}

<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
  <!-- Page Header -->
  <div class="mb-6">
    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">Dashboard</h1>
    <p class="text-sm text-gray-500">Welcome back, Admin! Here's what's happening today.</p>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 mb-6">
    <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
      <h2 class="text-sm text-gray-500">Total Users</h2>
      <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">1,245</p>
    </div>
    <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
      <h2 class="text-sm text-gray-500">Sales Today</h2>
      <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">$2,580</p>
    </div>
    <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
      <h2 class="text-sm text-gray-500">New Orders</h2>
      <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">67</p>
    </div>
    <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
      <h2 class="text-sm text-gray-500">Pending Support</h2>
      <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">4</p>
    </div>
  </div>

  <!-- Charts & Recent Activity -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <!-- Chart Placeholder -->
    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100">
      <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Sales Overview</h2>
      <div class="h-64 flex items-center justify-center text-gray-400">
        Chart goes here
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100">
      <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Recent Activity</h2>
      <ul class="space-y-4">
        <li class="flex justify-between text-sm text-gray-600">
          <span>John Doe registered</span>
          <span class="text-gray-400">2 hours ago</span>
        </li>
        <li class="flex justify-between text-sm text-gray-600">
          <span>New order from #4567</span>
          <span class="text-gray-400">3 hours ago</span>
        </li>
        <li class="flex justify-between text-sm text-gray-600">
          <span>Password reset for user "admin"</span>
          <span class="text-gray-400">5 hours ago</span>
        </li>
      </ul>
    </div>
  </div>
</div>
