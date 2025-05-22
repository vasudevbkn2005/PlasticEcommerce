<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max((int) $request->input('quantity', 1), 0);
        $update = $request->input('update', false);

        $product = Product::with('prices')->findOrFail($productId);
        $cart = session()->get('cart', []);

        // Remove if quantity is 0
        if ($quantity <= 0) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->where('product_id', $productId)->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart',
                'cart' => $cart,
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $update ? $quantity : ($cart[$productId]['quantity'] + $quantity);
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->prices->first()?->final_price ?? 0,
                'quantity' => $quantity,
                'image' => $product->mimage ? asset('storage/' . $product->mimage) : null,
            ];
        }

        session()->put('cart', $cart);

        if (Auth::check()) {
            $cartItem = Cart::firstOrNew([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);

            $cartItem->quantity = $update ? $quantity : ($cartItem->exists ? $cartItem->quantity + $quantity : $quantity);
            $cartItem->save();
        }

        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart' => $cart,
        ]);
    }
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::with(['product.prices'])->where('user_id', $userId)->get();

        // Collect product IDs in the cart
        $productIds = $cartItems->pluck('product_id')->unique();

        // Fetch bulk prices for these products
        $bulkPrices = \App\Models\Bulk::whereIn('product_id', $productIds)
            //->where('user_id', $userId) // Uncomment if bulk prices are user-specific
            ->get()
            ->groupBy('product_id');

        $cartTotal = 0;
        $cartOriginalTotal = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;
            $price = $product->prices->first();

            // Find applicable bulk price (highest bulk_order_quantity <= item quantity)
            $bulks = $bulkPrices->get($product->id) ?? collect();
            $bulk = $bulks->where('bulk_order_quantity', '<=', $item->quantity)
                ->sortByDesc('bulk_order_quantity')
                ->first();

            $priceToUse = $bulk ? $bulk->price : $price->final_price;

            $cartOriginalTotal += $price->price * $item->quantity;
            $cartTotal += $priceToUse * $item->quantity;
        }
        // Define GST rates (e.g., CGST and SGST or IGST)
        $gstRates = [
            'CGST' => 0.18,  // 9%
        ];

        // Calculate GST amounts
        $gstAmounts = [];
        foreach ($gstRates as $name => $rate) {
            $gstAmounts[$name] = $cartTotal * $rate;
        }

        // Total amount including GST
        $totalAmountWithGst = $cartTotal + array_sum($gstAmounts);


        $savedAmount = $cartOriginalTotal - $cartTotal - array_sum($gstAmounts);

        return view('livewire.frontend.cart', compact('cartItems', 'cartTotal', 'cartOriginalTotal', 'gstAmounts', 'savedAmount'));
    }
    public function destroy(Request $request)
    {
        $productId = $request->input('product_id'); // get product id from form

        // Remove from session cart
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        // Remove from database cart (if user is logged in)
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        }

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
    public function checkout()
    {
        $user = Auth::user();  // Get the logged-in user
        $cart = Cart::with('product.prices')->where('user_id', $user->id)->get();  // Fetch cart items with prices

        // Initialize totals
        $cartTotal = 0;
        $cartOriginalTotal = 0;

        // Collect bulk prices for optimization
        $productIds = $cart->pluck('product_id')->unique();
        $bulkPrices = \App\Models\Bulk::whereIn('product_id', $productIds)
            ->get()
            ->groupBy('product_id');

        // Calculate total for the cart
        foreach ($cart as $item) {
            $product = $item->product;
            $price = $product->prices->first();

            // Find applicable bulk price (highest bulk_order_quantity <= item quantity)
            $bulks = $bulkPrices->get($product->id) ?? collect();
            $bulk = $bulks->where('bulk_order_quantity', '<=', $item->quantity)
                ->sortByDesc('bulk_order_quantity')
                ->first();

            $priceToUse = $bulk ? $bulk->price : $price->final_price;

            // Attach calculated price to item for display in the view
            $item->calculated_price = $priceToUse;

            $cartOriginalTotal += $price->price * $item->quantity;
            $cartTotal += $priceToUse * $item->quantity;
        }

        // Add GST (5%)
        $gst = $cartTotal * 0.18;

        // Final total with GST
        $finalTotal = $cartTotal + $gst;

        // Pass data to the view
        return view('livewire.frontend.checkout', compact('user', 'cart', 'finalTotal', 'gst', 'cartOriginalTotal'));
    }
    // public function checkout()
    // {
    //     $user = Auth::user();  // Get the logged-in user
    //     $cart = Cart::where('user_id', $user->id)->get();  // Fetch cart items for that user

    //     // Initialize totals
    //     $cartTotal = 0;
    //     $cartOriginalTotal = 0;

    //     // Collect bulk prices for optimization
    //     $productIds = $cart->pluck('product_id')->unique();
    //     $bulkPrices = \App\Models\Bulk::whereIn('product_id', $productIds)
    //         ->get()
    //         ->groupBy('product_id');

    //     // Calculate total for the cart
    //     foreach ($cart as $item) {
    //         $product = $item->product;
    //         $price = $product->prices->first();

    //         // Find applicable bulk price (highest bulk_order_quantity <= item quantity)
    //         $bulks = $bulkPrices->get($product->id) ?? collect();
    //         $bulk = $bulks->where('bulk_order_quantity', '<=', $item->quantity)
    //             ->sortByDesc('bulk_order_quantity')
    //             ->first();

    //         $priceToUse = $bulk ? $bulk->price : $price->final_price;

    //         // Update original and total prices
    //         $cartOriginalTotal += $price->price * $item->quantity;
    //         $cartTotal += $priceToUse * $item->quantity;
    //     }

    //     // Add GST (assuming 5% for now)
    //     $gst = $cartTotal * 0.05;

    //     // Final total with GST
    //     $finalTotal = $cartTotal + $gst;

    //     // Pass data to the view
    //     return view('livewire.frontend.checkout', compact('user', 'cart', 'finalTotal', 'gst', 'cartOriginalTotal'));
    // }
}
