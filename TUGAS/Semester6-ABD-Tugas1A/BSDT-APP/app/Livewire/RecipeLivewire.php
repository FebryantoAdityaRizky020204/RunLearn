<?php

namespace App\Livewire;

use App\Models\Medicine;
use Livewire\Component;
use App\Models\Recipe;
use App\Models\Visit;

class RecipeLivewire extends Component
{
    public $recipe_id, $med_id, $visit_id, $med_dose, $med_frekuensi = '';

    public function render() { 
        return view('livewire.comp-page.recipe', [
            'data' => Recipe::all(),
            'med' => Medicine::all(),
            'visit' => Visit::all()
        ]);
    }

    public function mount() {
        
    }

    public function resetInputs(){
        $this->recipe_id = '';
        $this->med_id = '';
        $this->visit_id = '';
        $this->med_dose = '';
        $this->med_frekuensi = '';
    }

    public function addRecipe(){
        $this->validate([
            'recipe_id' => 'required',
            'med_id' => 'required',
            'visit_id' => 'required',
            'med_dose' => 'required',
            'med_frekuensi' => 'required',
        ]);

        Recipe::create([
            'recipe_id' => $this->recipe_id,
            'med_id' => $this->med_id,
            'visit_id' => $this->visit_id,
            'med_dose' => $this->med_dose,
            'med_frekuensi' => $this->med_frekuensi
        ]);

        $this->resetInputs();
    }

    public function showEditRecipe($recipe_id) {
        $recipe = Recipe::find($recipe_id);
        $this->recipe_id = $recipe->recipe_id;
        $this->med_id = $recipe->med_id;
        $this->visit_id = $recipe->visit_id;
        $this->med_dose = $recipe->med_dose;
        $this->med_frekuensi = $recipe->med_frekuensi;
    }

    public function editRecipe(){
        $this->validate([
            'recipe_id' => 'required',
            'med_id' => 'required',
            'visit_id' => 'required',
            'med_dose' => 'required',
            'med_frekuensi' => 'required',
        ]);

        $recipe = Recipe::find($this->recipe_id);
        $recipe->update([
            'recipe_id' => $this->recipe_id,
            'med_id' => $this->med_id,
            'visit_id' => $this->visit_id,
            'med_dose' => $this->med_dose,
            'med_frekuensi' => $this->med_frekuensi
        ]);

        $this->resetInputs();
    }

    public function showHapusRecipe($recipe_id) {
        $recipe = Recipe::find($recipe_id);
        $this->recipe_id = $recipe->recipe_id;
        $this->med_id = $recipe->med_id;
        $this->visit_id = $recipe->visit_id;
    }

    public function deleteRecipe(){
        $recipe = Recipe::find($this->recipe_id);
        $recipe->delete();
        $this->resetInputs();
    }



    
}