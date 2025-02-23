<?php

namespace App\Livewire\App;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $page, $data = null;

    public function render()
    {
        return view('livewire.app.index');
    }

    public function mount(){
        $this->page = 'home';
    }

    public function changePage($changepage) {
        $this->page = $changepage;
    }
}