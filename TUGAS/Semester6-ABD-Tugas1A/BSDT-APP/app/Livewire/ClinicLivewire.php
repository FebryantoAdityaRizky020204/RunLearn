<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clinic;

class ClinicLivewire extends Component
{
    // public $data = null;
    public $id_klinik, $nama_klinik, $alamat_klinik, $nomor_telepon_klinik = null;

    public function render()
    {
        return view('livewire.comp-page.clinic', [
            'data' => Clinic::all(),
        ]);
    }

    public function mount() {
        
    }

    public function resetInputs(){
        $this->id_klinik = '';
        $this->nama_klinik = '';
        $this->alamat_klinik = '';
        $this->nomor_telepon_klinik = '';
    }

    public function addClinic(){
        $this->validate([
            'id_klinik' => 'required',
            'nama_klinik' => 'required',
            'alamat_klinik' => 'required',
            'nomor_telepon_klinik' => 'required',
        ]);
        Clinic::create([
            'clinic_id' => $this->id_klinik,
            'clinic_name' => $this->nama_klinik,
            'clinic_address' => $this->alamat_klinik,
            'clinic_num_telp' => $this->nomor_telepon_klinik,
        ]);
        $this->resetInputs();
    }

    public function showEditClinic($id){
        $clinic = Clinic::find($id);
        $this->id_klinik = $clinic->clinic_id;
        $this->nama_klinik = $clinic->clinic_name;
        $this->alamat_klinik = $clinic->clinic_address;
        $this->nomor_telepon_klinik = $clinic->clinic_num_telp;
    }

    public function editClinic(){
        $this->validate([
            'id_klinik' => 'required',
            'nama_klinik' => 'required',
            'alamat_klinik' => 'required',
            'nomor_telepon_klinik' => 'required',
        ]);
        
        $clinic = Clinic::find($this->id_klinik);
        $clinic->update([
            'clinic_name' => $this->nama_klinik,
            'clinic_address' => $this->alamat_klinik,
            'clinic_num_telp' => $this->nomor_telepon_klinik,
        ]);
        $this->resetInputs();
    }

    public function showHapusClinic($id){
        $clinic = Clinic::find($id);
        $this->id_klinik = $clinic->clinic_id;
        $this->nama_klinik = $clinic->clinic_name;
    }

    public function deleteClinic(){
        $clinic = Clinic::find($this->id_klinik);
        $clinic->delete();
        $this->resetInputs();
    }

    
}