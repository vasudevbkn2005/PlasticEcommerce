<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductView extends Component
{
    public $selectedProductId;
    public $product;

    public function mount($id)
    {
        $this->selectedProductId = $id;
        $this->product = Product::findOrFail($id); // Load product
    }

    public function render()
    {
        return view('livewire.frontend.product-view', [
            'product' => $this->product,
        ]);
    }
}
