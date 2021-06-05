<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondTeacher extends Model
{
   
    protected $fillable = [
        'iin', 'first_name', 'middle_name', 'last_name', 'date_birth', 'gender', 'citizen', 'nation',
        'current_status', 'rank', 'type_of_busy', 'academic_degree','degree', 'studying', 'pre_work_history', 
        'curr_overall_work_history', 'curr_ped_work_history', 'company_work_history', 'address', 'email', 
        'phone', 'sanat', 'lang', 'english_level'
    ];
}
