<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondReportsStruc extends Model
{
    protected $fillable = [
        'name', 'sanat', 'sanat_start_date', 'sanat_end_date', 'certificate_no', 'certificate_picture'
    ];
}
