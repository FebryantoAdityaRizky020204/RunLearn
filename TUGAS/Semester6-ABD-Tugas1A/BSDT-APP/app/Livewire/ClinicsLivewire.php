<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clinic;
use App\Models\Veterinarian;
use App\Models\VeterinarianSpecialist;

class ClinicsLivewire extends Component {

    public $id_klinik, $nama_klinik, $alamat_klinik, $nomor_telepon_klinik = '';
    public $vet_id, $vet_fullname, $vet_num_telp, $vet_start_date, $vet_contract_status, $clinic_id = '';
    public $vet_sp_id, $specialist_field, $vet_sp_contract_status = '';
    
    public function render(){
        return view('livewire.comp-page.clinics', [
            'clinics' => Clinic::all(),
            'vets' => Veterinarian::all()
        ]);
    }

    public function resetInputs(){
        $this->id_klinik = '';
        $this->nama_klinik = '';
        $this->alamat_klinik = '';
        $this->nomor_telepon_klinik = '';

        $this->vet_id = '';
        $this->vet_fullname = '';
        $this->vet_num_telp = '';
        $this->vet_start_date = '';
        $this->vet_contract_status = '';
        $this->clinic_id = '';

        $this->vet_sp_id = '';
        $this->specialist_field = '';
        $this->vet_sp_contract_status = '';
    }

    public function addClinic(){
        $this->validate([
            'id_klinik' => 'required',
            'nama_klinik' => 'required',
            'alamat_klinik' => 'required',
            'nomor_telepon_klinik' => 'required|numeric',
        ]);
        Clinic::create([
            'clinic_id' => $this->id_klinik,
            'clinic_name' => $this->nama_klinik,
            'clinic_address' => $this->alamat_klinik,
            'clinic_num_telp' => $this->nomor_telepon_klinik,
        ]);
        $this->resetInputs();
    }

    public function showAddVeterinarian($cl_id){
        $this->clinic_id = $cl_id;
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

    public function showAddVeterinarianSpecialist($clinic_id) {
        $this->clinic_id = $clinic_id;
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

}