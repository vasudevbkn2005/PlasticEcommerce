<?php

namespace App\Livewire;

use Livewire\Component;

class ProductList extends Component
{
    // // Search query variable
    // public $searchQuery = '';

    // // Function to fetch products based on search query
    // public function updatedSearchQuery()
    // {
    //     $this->render();
    // }

    // // Render function to display products
    // public function render()
    // {
    //     // Fetch products based on search query
    //     $products = Product::where('name', 'like', "%{$this->searchQuery}%")->get();

    //     return view('livewire.product-list', [
    //         'products' => $products
    //     ]);
    // }
    public $currentPage = 'home';

    protected $listeners = ['pageChanged' => 'changePage'];

    public function changePage($page)
    {
        $this->currentPage = $page;
    }

    public function render()
    {
        return view('livewire.frontend.product-list');
    }
}
