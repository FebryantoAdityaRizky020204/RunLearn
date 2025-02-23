<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FollowUpVisit;
use App\Models\Visit;

class FollowUpVisitLivewire extends Component
{
    public $fu_visit_id, $visit_previous, $fu_visit_action, $visit_id = '';

    public function render(){ 
        return view('livewire.comp-page.follow-up-visit', [
            'data' => FollowUpVisit::all(),
            'visit' => Visit::all()
        ]);
    }

    public function mount() {
        
    }

    public function resetInputs(){
        $this->fu_visit_id = '';
        $this->visit_previous = '';
        $this->fu_visit_action = '';
        $this->visit_id = '';
    }

    public function addFUVisit(){
        $this->validate([
            'fu_visit_id' => 'required',
            'visit_previous' => 'required',
            'fu_visit_action' => 'required',
            'visit_id' => 'required',
        ]);

        FollowUpVisit::create([
            'fu_visit_id' => $this->fu_visit_id,
            'visit_previous' => $this->visit_previous,
            'fu_visit_action' => $this->fu_visit_action,
            'visit_id' => $this->visit_id,
        ]);

        $this->resetInputs();
    }

    public function showEditFUVisit($visit_id){
        $visit = FollowUpVisit::find($visit_id);
        $this->fu_visit_id = $visit->fu_visit_id;
        $this->visit_previous = $visit->visit_previous;
        $this->fu_visit_action = $visit->fu_visit_action;
        $this->visit_id = $visit->visit_id;
    }

    public function editFUVisit(){
        $this->validate([
            'fu_visit_id' => 'required',
            'visit_previous' => 'required',
            'fu_visit_action' => 'required',
            'visit_id' => 'required',
        ]);

        $fuvisit = FollowUpVisit::find($this->fu_visit_id);
        $fuvisit->update([
            'fu_visit_id' => $this->fu_visit_id,
            'visit_previous' => $this->visit_previous,
            'fu_visit_action' => $this->fu_visit_action,
            'visit_id' => $this->visit_id,
        ]);

        $this->resetInputs();
    }

    public function showHapusFUVisit($visit_id){
        $visit = FollowUpVisit::find($visit_id);
        $this->fu_visit_id = $visit->fu_visit_id;
        $this->visit_previous = $visit->visit_previous;
        $this->fu_visit_action = $visit->fu_visit_action;
        $this->visit_id = $visit->visit_id;
    }

    public function deleteFUVisit(){
        $visit = FollowUpVisit::find($this->fu_visit_id);
        $visit->delete();
        $this->resetInputs();
    }

    
}