<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'group', 'date', 'order', 'advisor'
    ];
}
