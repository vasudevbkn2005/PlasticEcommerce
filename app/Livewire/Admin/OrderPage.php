<?php

namespace App\Livewire\Admin;

use App\Models\Bulk;
use App\Models\Order;
use Livewire\Component;

class OrderPage extends Component
{
    public $orders;

    public function mount()
    {
        // Eager load prices and bulks on products inside order items
        $this->orders = Order::with([
            'items.product.prices',
            'items.product.bulkOrders', // bulkOrders instead of bulk
        ])->latest()->get();
    }

    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $order->status = $newStatus;
        $order->save();

        // Refresh orders with prices and bulks eager loaded
        $this->orders = Order::with([
            'items.product.prices',
            'items.product.bulk',
        ])->latest()->get();

        session()->flash('success', 'Order status updated successfully.');
    }

    public function render()
    {
        // You can load bulkOrders if needed in the view; otherwise omit this.
        $bulkOrders = Bulk::with('product', 'user')->get();

        return view('livewire.admin.order-page', [
            'orders' => $this->orders,
            'bulkOrders' => $bulkOrders,
        ]);
    }
}
