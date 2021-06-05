<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondReportAchivement extends Model
{
    protected $fillable = [
        'name', 'topic', 'contest', 'place', 'year', 'level', 'date', 'win', 'id_no', 'diplom'
    ];
}
