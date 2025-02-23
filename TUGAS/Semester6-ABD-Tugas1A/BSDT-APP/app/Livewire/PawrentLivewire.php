<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pawrent;
use App\Models\Pet;

class PawrentLivewire extends Component
{
    public $paw_id, $paw_fullname, $paw_num_telp = '';
    
    public $pet_id, $pet_name, $pet_year_of_birth, $pet_type = '';

    public function render()
    {
        return view('livewire.comp-page.pawrent',
            [
                'data' => Pawrent::all(),
                'pet' => Pet::all(),
            ]
        );
    }

    public function mount() {

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

    /** 
     * @method untuk Pawrent
     */

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

    public function showEditPawrent($id){
        $paw = Pawrent::find($id);
        $this->paw_id = $paw->paw_id;
        $this->paw_fullname = $paw->paw_fullname;
        $this->paw_num_telp = $paw->paw_num_telp;
    }

    public function editPawrent(){
        $this->validate([
            'paw_id' => 'required',
            'paw_fullname' => 'required',
            'paw_num_telp' => 'required',
        ]);

        $paw = Pawrent::find($this->paw_id);
        $paw->update([
            'paw_id' => $this->paw_id,
            'paw_fullname' => $this->paw_fullname,
            'paw_num_telp' => $this->paw_num_telp,
        ]);

        $this->resetInputs();
    }

    public function showHapusPawrent($id){
        $paw = Pawrent::find($id);
        $this->paw_id = $paw->paw_id;
        $this->paw_fullname = $paw->paw_fullname;
    }

    public function deletePawrent(){
        Pet::where('paw_id', $this->paw_id)->get()->each->delete();
        $paw = Pawrent::find($this->paw_id);
        $paw->delete();

        $this->resetInputs();
    }

    /** 
     * @method untuk Pet
     */

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

    public function showEditPet($id){
        $pet = Pet::find($id);
        $this->pet_id = $pet->pet_id;
        $this->pet_name = $pet->pet_name;
        $this->pet_year_of_birth = $pet->pet_year_of_birth;
        $this->pet_type = $pet->pet_type;
        $this->paw_id = $pet->paw_id;
    }

    public function editPet(){
        $this->validate([
            'pet_id' => 'required',
            'pet_name' => 'required',
            'pet_year_of_birth' => 'required',
            'pet_type' => 'required',
        ]);

        $pet = Pet::find($this->pet_id);
        $pet->update([
            'pet_name' => $this->pet_name,
            'pet_year_of_birth' => $this->pet_year_of_birth,
            'pet_type' => $this->pet_type,
            'pawrent_id' => $this->paw_id,
        ]);

        $this->resetInputs();
    }

    public function showHapusPet($id){
        $pet = Pet::find($id);
        $this->pet_id = $pet->pet_id;
        $this->pet_name = $pet->pet_name;
    }

    public function deletePet(){
        $pet = Pet::find($this->pet_id);
        $pet->delete();
        $this->resetInputs();
    }

}