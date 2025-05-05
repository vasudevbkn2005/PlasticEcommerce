<?php

namespace App\Livewire;

use Livewire\Component;

class PageChange extends Component
{
    public $page = 'dashboard';

    protected $listeners = ['pageChanged' => 'loadPage'];

    public function loadPage($page)
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.Admin.page-change');
    }
}
