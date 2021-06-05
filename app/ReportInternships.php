<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportInternships extends Model
{
    protected $fillable = [
        'name', 'service', 'post', 'edu_received', 'message', 'date', 'place'
    ];
}
