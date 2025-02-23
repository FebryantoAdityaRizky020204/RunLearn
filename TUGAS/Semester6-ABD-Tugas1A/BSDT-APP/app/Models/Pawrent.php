<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Pet;

class Pawrent extends Model
{
    protected $table = 'tb_pawrent';
    protected $primaryKey = 'paw_id';
    public $fillable = [
        'paw_id',
        'paw_fullname',
        'paw_num_telp'
    ];
    public $timestamps = false;


    public function pets(): HasMany {
        return $this->hasMany(Pet::class, 'paw_id');
    }
}