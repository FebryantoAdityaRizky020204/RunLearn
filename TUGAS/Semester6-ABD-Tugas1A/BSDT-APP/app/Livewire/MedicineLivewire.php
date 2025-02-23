<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicine;

class MedicineLivewire extends Component
{
    public $med_id, $med_name, $med_direction = '';

    public function render()
    {
        return view('livewire.comp-page.medicine',
            ['data' => Medicine::all()]
        );
    }

    public function mount() {
        
    }

    public function resetInputs() {
        $this->med_id = '';
        $this->med_name = '';
        $this->med_direction = '';
    }

    public function addMedicine(){
        $this->validate([
            'med_id' => 'required',
            'med_name' => 'required',
            'med_direction' => 'required',
        ]);
        Medicine::create([
            'med_id' => $this->med_id,
            'med_name' => $this->med_name,
            'med_direction' => $this->med_direction,
        ]);
        $this->resetInputs();
    }

    public function showEditMedicine($id) {
        $medicine = Medicine::find($id);
        $this->med_id = $medicine->med_id;
        $this->med_name = $medicine->med_name;
        $this->med_direction = $medicine->med_direction;
    }

    public function editMedicine() {
        $this->validate([
            'med_id' => 'required',
            'med_name' => 'required',
            'med_direction' => 'required',
        ]);
        $medicine = Medicine::find($this->med_id);
        $medicine->update([
            'med_id' => $this->med_id,
            'med_name' => $this->med_name,
            'med_direction' => $this->med_direction,
        ]);
        $this->resetInputs();
    }

    public function showHapusMedicine($id){
        $medicine = Medicine::find($id);
        $this->med_id = $medicine->med_id;
        $this->med_name = $medicine->med_name;
    }

    public function deleteMedicine() {
        $medicine = Medicine::find($this->med_id);
        $medicine->delete();
        $this->resetInputs();
    }
}