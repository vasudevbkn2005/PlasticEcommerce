<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.frontend.myorder', compact('orders'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'pin' => 'required|string|max:10',
            'payment_method' => 'required|in:cod,online',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->payment_method === 'online') {
            $request->validate([
                'screenshot' => 'required|image|',
            ]);
        }

        // Screenshot upload
        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('screenshots', 'public');
        }

        // Get cart items
        $cartItems = Cart::with('product.prices')->where('user_id', Auth::id())->get();


        // Calculate prices
        $subTotal = 0;
        $productIds = $cartItems->pluck('product_id');
        $bulkPrices = \App\Models\Bulk::whereIn('product_id', $productIds)->get()->groupBy('product_id');

        foreach ($cartItems as $item) {
            $price = $item->product->prices->first();
            $bulks = $bulkPrices->get($item->product_id) ?? collect();
            $bulk = $bulks->where('bulk_order_quantity', '<=', $item->quantity)->sortByDesc('bulk_order_quantity')->first();
            $calculatedPrice = $bulk ? $bulk->price : $price->final_price;

            $item->calculated_price = $calculatedPrice; // Attach for later use
            $subTotal += $calculatedPrice * $item->quantity;
        }

        $gst = round($subTotal * 0.18, 2);
        $finalTotal = $subTotal + $gst;

        // Save everything in transaction
        $order = Order::create([
            'user_id' => Auth::id(),
            'fullName' => $request->fullName,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'pin' => $request->pin,
            'payment_method' => $request->payment_method,
            'screenshot' => $screenshotPath,
            'total' => $finalTotal,
            'gst' => $gst,
            'status' => 'Pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->calculated_price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect('/my-orders')->with('success', 'Order placed successfully!');
    }
    public function download(Order $order)
    {
        $pdf = PDF::loadView('invoice', compact('order'));
        return $pdf->download('invoice_order_' . $order->id . '.pdf');
    }
}
