<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUpVisit extends Model
{
    protected $table = 'tb_follow_up_visit';
    protected $primaryKey = 'fu_visit_id';
    protected $fillable = [
        'fu_visit_id',
        'visit_previous',
        'fu_visit_action',
        'visit_id'
    ];
    public $timestamps = false;
}