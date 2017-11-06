<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    public function grades()
    {
        $this->hasOne('App\Grade');
    }
}
