<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ProductView;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Models\Bulk;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('wel');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product/{id}', function ($id) {
        $product = Product::with(['prices', 'otherImages' ,'bulkOrders'])->findOrFail($id);

        // Assume cart is stored in session as an array of items
        $cart = session('cart', []);
        $quantityInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $bulk = $product->bulkOrders;

        // Optional: fetch related products logic
        // $relatedProducts = Product::where('id', '!=', $product->id)->take(4)->get();

        return view('livewire.frontend.product-view', compact('product', 'quantityInCart','bulk'));
    })->name('product.show');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    // Route::get('/product/{id}', ProductView::class)->name('product.view');
});

Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.base');
    });
});

require __DIR__ . '/auth.php';
