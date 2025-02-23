<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    protected $table = 'tb_clinic';
    protected $primaryKey = 'clinic_id';
    protected $fillable = [
        'clinic_id',
        'clinic_name',
        'clinic_address',
        'clinic_num_telp',
    ];
    public $timestamps = false;


    public function veterinarians() : HasMany {
        return $this->hasMany(Veterinarian::class, 'clinic_id');
    }

    public function veterinariansSpecialists() : HasMany {
        return $this->hasMany(VeterinarianSpecialist::class, 'clinic_id');
    }

    public function getScopeVetSp(){
        return VeterinarianSpecialist::where('clinic_id', $this->clinic_id)->with('veterinarian')->get();
    }
}