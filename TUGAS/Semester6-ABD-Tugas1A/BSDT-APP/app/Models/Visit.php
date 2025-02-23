<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    protected $table = 'tb_visit';
    protected $primaryKey = 'visit_id';
    protected $fillable = [
        'visit_id',
        'visit_date',
        'pet_id',
        'vet_id',
        'clinic_id',
        'visit_diaknosa',
    ];
    
    public $timestamps = false;

    public function pet() : BelongsTo {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function veterinarian() : BelongsTo {
        return $this->belongsTo(Veterinarian::class, 'vet_id');
    }

    public function clinic() : BelongsTo {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}