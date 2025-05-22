<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-500">Welcome back, Admin! Here's what's happening today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-4 sm:gap-6 mb-6">
        <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-sm text-gray-500">Total Users</h2>
            <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-sm text-gray-500">Total Sale</h2>
            <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">₹{{ number_format($totalSales, 2) }}</p>
        </div>
        <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-sm text-gray-500">Sales Today</h2>
            <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">₹{{ number_format($salesToday, 2) }}</p>
        </div>
        <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-sm text-gray-500">New Orders</h2>
            <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">{{ $newOrders }}</p>
        </div>
        <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-sm text-gray-500">Pending Support</h2>
            <p class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">{{ $pendingSupport }}</p>
        </div>
    </div>


    <!-- Charts & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        <!-- Chart -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Sales Overview</h2>
            <canvas id="salesChart" class="w-full h-64"></canvas>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-4">Recent Activity</h2>
            <ul class="space-y-4">
                @forelse ($recentActivities as $activity)
                    <li class="flex justify-between text-sm text-gray-600">
                        <span>{{ $activity['text'] }}</span>
                        <span class="text-gray-400">{{ $activity['time'] }}</span>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">No recent activity available.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');

        const labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        const salesData = @json($salesData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales (₹)',
                    data: salesData,
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₹' + value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#374151'
                        }
                    }
                }
            }
        });
    });
</script>
