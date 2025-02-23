<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'tb_medicine';
    protected $primaryKey = 'med_id';
    protected $fillable = [
        'med_id',
        'med_name',
        'med_direction'
    ];
    public $timestamps = false;
}