<?php

namespace App\Livewire;

use App\Models\Clinic;
use App\Models\Pet;
use App\Models\Veterinarian;
use Livewire\Component;
use App\Models\Visit;

class VisitLivewire extends Component
{
    public $visit_id, $visit_date, $pet_id, $vet_id, $clinic_id, $visit_diaknosa = '';

    public function render()
    {
        return view('livewire.comp-page.visit', [
            'data' => Visit::all(),
            'pet' => Pet::all(),
            'vet' => Veterinarian::all(),
            'clinic' => Clinic::all(),
        ]);
    }

    public function mount() {
        
    }

    public function resetInputs(){
        $this->visit_id = '';
        $this->visit_date = '';
        $this->pet_id = '';
        $this->vet_id = '';
        $this->clinic_id = '';
        $this->visit_diaknosa = '';
    }

    public function addVisit(){
        $this->validate([
            'visit_id' => 'required',
            'visit_date' => 'required',
            'pet_id' => 'required',
            'vet_id' => 'required',
            'clinic_id' => 'required',
            'visit_diaknosa' => 'required',
        ]);

        Visit::create([
            'visit_id' => $this->visit_id,
            'visit_date' => $this->visit_date,
            'pet_id' => $this->pet_id,
            'vet_id' => $this->vet_id,
            'clinic_id' => $this->clinic_id,
            'visit_diaknosa' => $this->visit_diaknosa,
        ]);

        $this->resetInputs();
    }

    public function showEditVisit($visit_id){
        $visit = Visit::find($visit_id);
        $this->visit_id = $visit->visit_id;
        $this->visit_date = $visit->visit_date;
        $this->pet_id = $visit->pet_id;
        $this->vet_id = $visit->vet_id;
        $this->clinic_id = $visit->clinic_id;
        $this->visit_diaknosa = $visit->visit_diaknosa;
    }

    public function editVisit(){
        $this->validate([
            'visit_id' => 'required',
            'visit_date' => 'required',
            'pet_id' => 'required',
            'vet_id' => 'required',
            'clinic_id' => 'required',
            'visit_diaknosa' => 'required',
        ]);

        $visit = Visit::find($this->visit_id);
        $visit->update([
            'visit_id' => $this->visit_id,
            'visit_date' => $this->visit_date,
            'pet_id' => $this->pet_id,
            'vet_id' => $this->vet_id,
            'clinic_id' => $this->clinic_id,
            'visit_diaknosa' => $this->visit_diaknosa,
        ]);

        $this->resetInputs();
    }

    public function showHapusVisit($visit_id){
        $visit = Visit::find($visit_id);
        $this->visit_id = $visit->visit_id;
        $this->pet_id = $visit->pet_id;
        $this->visit_date = $visit->visit_date;
    }

    public function deleteVisit(){
        $visit = Visit::find($this->visit_id);
        $visit->delete();
        $this->resetInputs();
    }

    
}