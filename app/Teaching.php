<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    protected $table = 'teaching';
    public $timestamps = false;

    public function professor()
    {
        return $this->hasOne('App\Professor', 'ProfessorId', 'ProfessorId');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject', 'SubjectId', 'SubjectId');
    }
}
