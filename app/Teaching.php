<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    protected $table = 'teaching';
    public $primaryKey = 'TeachingId';
    public $incrementing = false;
    public $timestamps = false;

    public function professor()
    {
        return $this->hasOne('App\Professor', 'ProfessorId', 'ProfessorId');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject', 'SubjectShortTitle', 'SubjectShortTitle');
    }
//    public function schedules()
//    {
//        return $this
//            ->hasMany('App\Schedule', 'TeachingId', 'TeachingId')
//            ->orderBy('LessonDate')
//            ->orderBy('LessonNumber');
//    }
}
