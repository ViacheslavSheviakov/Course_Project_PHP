<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $primaryKey = 'SubjectShortTitle';
    public $incrementing = false;
    public $timestamps = false;
}
