<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserPage extends Component
{
    public function render()
    {
        // Get all users
        $users = User::all();

        // Pass users collection to the view
        return view('livewire.admin.user-page', compact('users'));
    }
}
