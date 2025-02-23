<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VeterinarianSpecialist;
use App\Models\Veterinarian;
use App\Models\Clinic;

class VeterinarianSpecialistLivewire extends Component
{
    public $vet_sp_id, $vet_id, $specialist_field, $vet_sp_contract_status, $clinic_id = '';

    public function render() { 
        return view('livewire.comp-page.veterinarian-specialist', [ 
            'data' => VeterinarianSpecialist::all(),
            'clinic' => Clinic::all(),
            'vet' => Veterinarian::all(),
        ]);
    }

    public function mount() {
        
    }

    public function resetInputs(){
        $this->vet_sp_id = '';
        $this->vet_id = '';
        $this->specialist_field = '';
        $this->vet_sp_contract_status = '';
        $this->clinic_id = '';
    }

    public function addVeterinarianSpecialist() {
        $this->validate([
            'vet_sp_id' => 'required',
            'vet_id' => 'required',
            'specialist_field' => 'required',
            'vet_sp_contract_status' => 'required',
            'clinic_id' => 'required',
        ]);

        VeterinarianSpecialist::create([
            'vet_sp_id' => $this->vet_sp_id,
            'vet_id' => $this->vet_id,
            'specialist_field' => $this->specialist_field,
            'vet_sp_contract_status' => $this->vet_sp_contract_status,
            'clinic_id' => $this->clinic_id
        ]);

        $this->resetInputs();
    }

    public function showEditVeterinarianSpecialist($id) {
        $vet_sp = VeterinarianSpecialist::find($id);
        $this->vet_sp_id = $vet_sp->vet_sp_id;
        $this->vet_id = $vet_sp->vet_id;
        $this->specialist_field = $vet_sp->specialist_field;
        $this->vet_sp_contract_status = $vet_sp->vet_sp_contract_status;
        $this->clinic_id = $vet_sp->clinic_id;
    }

    public function editVeterinarianSpecialist(){
        $this->validate([
            'vet_sp_id' => 'required',
            'vet_id' => 'required',
            'specialist_field' => 'required',
            'vet_sp_contract_status' => 'required',
            'clinic_id' => 'required',
        ]);

        $vet_sp = VeterinarianSpecialist::find($this->vet_sp_id);
        $vet_sp->update([
            'vet_sp_id' => $this->vet_sp_id,
            'vet_id' => $this->vet_id,
            'specialist_field' => $this->specialist_field,
            'vet_sp_contract_status' => $this->vet_sp_contract_status,
            'clinic_id' => $this->clinic_id
        ]);

        $this->resetInputs();
    }

    public function showHapusVeterinarianSpecialist($id){
        $vet_sp = VeterinarianSpecialist::find($id);
        $this->vet_sp_id = $vet_sp->vet_sp_id;
        $this->specialist_field = $vet_sp->specialist_field;
        $this->vet_id = $vet_sp->vet_id;
    }

    public function deleteVeterinarianSpecialist(){
        $vet_sp = VeterinarianSpecialist::find($this->vet_sp_id);
        $vet_sp->delete();

        $this->resetInputs();
    }
}