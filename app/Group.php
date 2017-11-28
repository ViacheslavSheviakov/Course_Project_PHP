<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $primaryKey = 'GroupShortTitle';
    public $incrementing = false;
    public $timestamps = false;

    public function schedules()
    {
        return $this
            ->hasMany('App\Schedule', 'GroupShortTitle', 'GroupShortTitle')
            ->orderBy('LessonDate')
            ->orderBy('LessonNumber');
    }

    public function professor()
    {
        return $this->hasOne('App\Professor', 'ProfessorId', 'CuratorId');
    }
}
