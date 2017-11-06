<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    public function grades()
    {
        return $this->hasMany('App\Grade', 'RecordBookId', 'RecordBookId');
    }
}
