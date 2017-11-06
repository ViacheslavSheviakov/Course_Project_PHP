<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $primaryKey = 'GroupShortTitle';
    public $incrementing = false;
    public $timestamps = false;
}
