<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondReportCourses extends Model
{
    protected $fillable = [
        'name', 'place', 'programm', 'subject', 'type', 'lang', 'date', 'start_date', 'end_date', 'year', 'certificate_no', 'certificate_picture'
    ];
}
