<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public $timestamps = false;

    public function teachings()
    {
        return $this->hasMany('App\Teaching', 'ProfessorId', 'ProfessorId');
    }
}
