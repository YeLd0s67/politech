<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportActivity extends Model
{
    protected $fillable = [
        'name', 'topic', 'date', 'status', 'edition'
    ];
}
