<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navbar extends Component
{
    public $searchQuery = '';

    // For mobile menu visibility
    public $showMobileMenu = false;

    // Method to toggle mobile menu visibility
    public function toggleMobileMenu()
    {
        $this->showMobileMenu = !$this->showMobileMenu;
    }
    // public $currentPage = 'home'; // default page

    public function changePage($page)
    {
        $this->dispatch('pageChanged', $page);
    }


    public function getCategoriesProperty()
    {
        return Category::all(); // Fetch all categories
    }

    public function render()
    {
        return view('livewire.frontend.navbar', [
            'categories' => $this->categories
        ]);
    }
}
