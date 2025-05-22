<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ProductView;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Bulk;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('wel');
});
Route::get('/about', function () {
    return view('livewire.frontend.product-about');
});
Route::get('/contact', function () {
    return view('livewire.frontend.product-contact');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product/{id}', function ($id) {
        $product = Product::with(['prices', 'otherImages', 'bulkOrders'])->findOrFail($id);

        // Assume cart is stored in session as an array of items
        $cart = session('cart', []);
        $quantityInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $bulk = $product->bulkOrders;
        $relatedProducts = Product::with('prices')
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Optional: fetch related products logic
        // $relatedProducts = Product::where('id', '!=', $product->id)->take(4)->get();

        return view('livewire.frontend.product-view', compact('product', 'quantityInCart', 'bulk', 'relatedProducts'));
    })->name('product.show');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/count', function () {
        $cart = session('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    })->name('cart.count');
    // Route::get('/product/{id}', ProductView::class)->name('product.view');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/place-order', [OrderController::class, 'store'])->name('place.order');
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/invoice/download/{order}', [OrderController::class, 'download'])->name('invoice.download');
});
Route::get('/search', function () {
    $query = request('query');
    $products = Product::where('name', 'like', "%{$query}%")->get();
    $category = Category::where('name', 'like', "%{$query}%")->first();
    return view('livewire.frontend.search', [
        'products' => $products,
        'searchTerm' => $query,
        'category' => $category,
    ]);
})->name('search.results');



Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.base');
    });
});

require __DIR__ . '/auth.php';
