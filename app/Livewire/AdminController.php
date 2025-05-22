<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Order;
use App\Models\SupportTicket;
use Livewire\Component;
use Carbon\Carbon;

class AdminController extends Component
{
    public $totalUsers;
    public $salesToday;
    public $newOrders;
    public $pendingSupport;
    public $salesData = [];
    public $recentActivities = [];
    public $totalSales;

    public function mount()
    {
        $this->totalUsers = User::count();

        $this->salesToday = Order::whereDate('created_at', Carbon::today())->sum('total');
        $this->newOrders = Order::whereDate('created_at', Carbon::today())->count();
        $this->pendingSupport = Order::where('status', 'pending')->count();
        $this->totalSales = Order::sum('total');

        // Sales data for last 7 days
        $this->salesData = collect(range(0, 6))->map(function ($i) {
            $date = Carbon::now()->subDays(6 - $i)->toDateString();
            return Order::whereDate('created_at', $date)->sum('total');
        })->toArray();

        // Example recent activities from orders (you can extend with more types)
        $this->recentActivities = Order::latest()->take(5)->get()->map(function ($order) {
            return [
                'text' => "Order #{$order->id} placed",
                'time' => $order->created_at->diffForHumans(),
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.admin.admin-controller', [
            'totalUsers' => $this->totalUsers,
            'salesToday' => $this->salesToday,
            'newOrders' => $this->newOrders,
            'pendingSupport' => $this->pendingSupport,
            'salesData' => $this->salesData,
            'recentActivities' => $this->recentActivities,
            'totalSales' => $this->totalSales,
        ]);
    }
}
