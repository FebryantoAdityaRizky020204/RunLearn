<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pet;

class PetLivewire extends Component
{
    public $data = null;

    public function render()
    {
        return view('livewire.comp-page.pet');
    }

    public function mount() {
        $this->data = "Clinic::all()";
    }

    
}