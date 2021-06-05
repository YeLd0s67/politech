<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $fillable = [
        'name', 'sanat', 'sanat_start_date', 'sanat_end_date', 'certificate_no', 'certificate_picture', 'dareje'
    ];
}
