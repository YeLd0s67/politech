<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achivement extends Model
{
    protected $fillable = [
        'name', 'groups', 'advisor', 'shara', 'level', 'shara_name', 'period', 'achivement'
    ];
}
