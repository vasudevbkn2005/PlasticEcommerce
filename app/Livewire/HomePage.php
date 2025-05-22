<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $sliders=Slide::all();
        $products=Product::all();
        $categories=Category::all();
        return view('livewire.frontend.home-page',compact('sliders','products', 'categories'));
    }
}
