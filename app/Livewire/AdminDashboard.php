<?php

namespace App\Livewire;

use Livewire\Component;

class AdminDashboard extends Component
{
    public function changePage($page)
    {
        $this->dispatch('pageChanged', $page);
    }

    public function render()
    {
        return view('livewire.Admin.admin-dashboard');
    }
}
