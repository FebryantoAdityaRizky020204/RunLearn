<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VeterinarianSpecialist;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Clinic;

class Veterinarian extends Model
{
    protected $table = 'tb_veterinarian';
    protected $primaryKey = 'vet_id';
    protected $fillable = [
        'vet_id',
        'vet_fullname',
        'vet_num_telp',
        'vet_start_date',
        'vet_contract_status',
        'clinic_id'
    ];
    public $timestamps = false;

    public function veterinarianSpecialist() : HasOne {
        return $this->hasOne(VeterinarianSpecialist::class, 'vet_id');
    }

    public function clinic(): BelongsTo {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}