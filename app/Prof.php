<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    protected $fillable = [
        'code', 'description', 'short_name', 'groups', 'file'
    ];
}
