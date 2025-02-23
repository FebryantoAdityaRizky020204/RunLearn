<?php

namespace App\Livewire;

use App\Models\Clinic;
use Livewire\Component;
use App\Models\Veterinarian;

class VeterinarianLivewire extends Component
{
    public $vet_id, $vet_fullname, $vet_num_telp, $vet_start_date, $vet_contract_status, $clinic_id = null;

    public function render()
    {
        return view('livewire.comp-page.veterinarian', 
            [
                'data' => Veterinarian::all(),
                'clinic' => Clinic::all(),
            ]
        );
    }

    public function mount() {
        
    }

    public function resetInputs(){
        $this->vet_id = '';
        $this->vet_fullname = '';
        $this->vet_num_telp = '';
        $this->vet_start_date = '';
        $this->vet_contract_status = '';
        $this->clinic_id = '';
    }



    public function addVeterinarian(){
        $this->validate([
            'vet_id' => 'required',
            'vet_fullname' => 'required',
            'vet_num_telp' => 'required',
            'vet_start_date' => 'required',
            'vet_contract_status' => 'required',
            'clinic_id' => 'required',
        ]);
        
        Veterinarian::create([
            'vet_id' => $this->vet_id,
            'vet_fullname' => $this->vet_fullname,
            'vet_num_telp' => $this->vet_num_telp,
            'vet_start_date' => $this->vet_start_date,
            'vet_contract_status' => $this->vet_contract_status,
            'clinic_id' => $this->clinic_id,
        ]);

        $this->resetInputs();
    }

    public function showEditVeterinarian($id){
        $vet = Veterinarian::find($id);
        $this->vet_id = $vet->vet_id;
        $this->vet_fullname = $vet->vet_fullname;
        $this->vet_num_telp = $vet->vet_num_telp;
        $this->vet_start_date = $vet->vet_start_date;
        $this->vet_contract_status = $vet->vet_contract_status;
        $this->clinic_id = $vet->clinic_id;
    }

    public function editVeterinarian(){
        $this->validate([
            'vet_id' => 'required',
            'vet_fullname' => 'required',
            'vet_num_telp' => 'required',
            'vet_start_date' => 'required',
            'vet_contract_status' => 'required',
            'clinic_id' => 'required',
        ]);

        $vet = Veterinarian::find($this->vet_id);
        $vet->update([
                'vet_id' => $this->vet_id,
                'vet_fullname' => $this->vet_fullname,
                'vet_num_telp' => $this->vet_num_telp,
                'vet_start_date' => $this->vet_start_date,
                'vet_contract_status' => $this->vet_contract_status,
                'clinic_id' => $this->clinic_id,
        ]);

        $this->resetInputs();
    }

    public function showHapusVeterinarian($id){
        $vet = Veterinarian::find($id);
        $this->vet_id = $vet->vet_id;
        $this->vet_fullname = $vet->vet_fullname;
    }

    public function deleteVeterinarian(){
        Veterinarian::find($this->vet_id)->delete();
        $this->resetInputs();
    }
    
}