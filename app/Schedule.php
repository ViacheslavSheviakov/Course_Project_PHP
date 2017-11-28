<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    public $timestamps = false;
    public $primaryKey = 'ScheduleId';

    public function group()
    {
        return $this->hasOne('App\Group', 'GroupShortTitle', 'GroupShortTitle');
    }

    public function teaching()
    {
        return $this->hasOne('App\Teaching', 'TeachingId', 'TeachingId');
    }
}
