<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    protected $table = 'tb_pet';
    protected $primaryKey = 'pet_id';
    protected $fillable = [
        'pet_id',
        'pet_name',
        'pet_year_of_birth',
        'pet_type',
        'paw_id'
    ];
    public $timestamps = false;

    public function pawrent(): BelongsTo {
        return $this->belongsTo(Pawrent::class, 'paw_id');
    }
}