<?php

namespace App\Livewire;

use Livewire\Component;

class HomeLivewire extends Component
{
    public $data = null;

    public function render()
    {
        return view('livewire.comp-page.home');
    }

    public function mount() {
        $this->data = 'Clinic::all()';
    }

    
}