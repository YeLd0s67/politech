<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportCourses extends Model
{
    protected $fillable = [
        'name', 'place', 'programm', 'subject', 'type', 'lang', 'date', 'certificate_no', 'certificate_picture', 'year'
    ];
}
