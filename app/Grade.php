<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $timestamps = false;

    public function schedule()
    {
        return $this->hasOne('App\Schedule', 'ScheduleId', 'ScheduleId');
    }
}
