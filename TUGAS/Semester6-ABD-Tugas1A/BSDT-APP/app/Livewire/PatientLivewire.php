<?php

namespace App\Livewire;

use App\Models\Pawrent;
use App\Models\Pet;
use Livewire\Component;

class PatientLivewire extends Component {
    public $paw_id, $paw_fullname, $paw_num_telp = '';
    public $pet_id, $pet_name, $pet_year_of_birth, $pet_type = '';
    
    public function render(){
        return view('livewire.comp-page.patient', [
            'pawrents' => Pawrent::all()
        ]);
    }

    public function resetInputs(){
        $this->paw_id = '';
        $this->paw_fullname = '';
        $this->paw_num_telp = '';

        $this->pet_id = '';
        $this->pet_name = '';
        $this->pet_year_of_birth = '';
        $this->pet_type = '';
    }

    public function addPawrent(){
        $this->validate([
            'paw_id' => 'required',
            'paw_fullname' => 'required',
            'paw_num_telp' => 'required',
        ]);

        Pawrent::create([
            'paw_id' => $this->paw_id,
            'paw_fullname' => $this->paw_fullname,
            'paw_num_telp' => $this->paw_num_telp,
        ]);

        $this->resetInputs();
    }

    public function showTambahPet($id) {
        $paw = Pawrent::find($id);
        $this->paw_id = $paw->paw_id;
        $this->paw_fullname = $paw->paw_fullname;
    }

    public function addPet(){
        $this->validate([
            'pet_id' => 'required',
            'pet_name' => 'required',
            'pet_year_of_birth' => 'required',
            'pet_type' => 'required',
        ]);

        Pet::create([
            'pet_id' => $this->pet_id,
            'pet_name' => $this->pet_name,
            'pet_year_of_birth' => $this->pet_year_of_birth,
            'pet_type' => $this->pet_type,
            'pawrent_id' => $this->paw_id,
            'paw_id' => $this->paw_id
        ]);

        $this->resetInputs();
    }
}