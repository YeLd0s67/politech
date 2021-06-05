<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'course', 'speciality', 'subject', 'teacher', 'hours', 'semester', 'exam'
    ];
}
