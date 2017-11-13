<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    protected $table = 'lesson_types';
    public $primaryKey = 'TypeShortTitle';
    public $incrementing = false;
    public $timestamps = false;
}
