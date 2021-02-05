<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model{

    protected $fillable = [
        'activities_name', 'start_date', 'end_date', 'language', 'user_commentaire', 'teacher_commentaire', 'user_id'
    ];

}

