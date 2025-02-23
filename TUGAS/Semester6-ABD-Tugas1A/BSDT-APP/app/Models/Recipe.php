<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Medicine;

class Recipe extends Model
{
    protected $table = 'tb_recipe';
    protected $primaryKey = 'recipe_id';
    protected $fillable = [
        'recipe_id',
        'med_id',
        'visit_id',
        'med_dose',
        'med_frekuensi'
    ];
    public $timestamps = false;

    public function medicine() : BelongsTo {
        return $this->belongsTo(Medicine::class, 'med_id');
    }
}