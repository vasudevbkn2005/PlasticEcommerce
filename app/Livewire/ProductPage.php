<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductPage extends Component
{
    public $selectedProductId = null;

    public function changePage($page, $id = null)
    {
        Log::info("🔁 Page change to: {$page}, Product ID: {$id}");
        $this->selectedProductId = $id;

        // Dispatch a custom event
        $this->dispatch('productSelected', ['id' => $id]);
        $this->dispatch('pageChanged', ['page' => $page]);
    }

    public function render()
    {
        $products = Product::all();
        return view('livewire.frontend.product-page', compact('products'));
    }
}
