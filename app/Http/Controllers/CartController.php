<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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
}
