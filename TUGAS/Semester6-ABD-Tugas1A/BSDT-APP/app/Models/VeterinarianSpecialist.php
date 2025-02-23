<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VeterinarianSpecialist extends Model
{
    protected $table = 'tb_veterinarian_specialist';
    protected $primaryKey = 'vet_sp_id';
    protected $fillable = [
        'vet_sp_id',
        'vet_id',
        'specialist_field',
        'vet_sp_contract_status',
        'clinic_id'
    ];
    public $timestamps = false;


    public function veterinarian() : BelongsTo {
        return $this->belongsTo(Veterinarian::class, 'vet_id');
    }
}