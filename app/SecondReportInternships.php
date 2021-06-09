<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondReportInternships extends Model
{
    protected $fillable = [
        'name', 'prof', 'place', 'employement', 'date', 'end_date', 'message', 'pic', 'year'
    ];
}
