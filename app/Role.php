<?php namespace App;

use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Klaravel\Ntrust\Traits\NtrustRoleTrait;

class Role extends Model
{
    use NtrustRoleTrait;

    protected $fillable = [
        'name',
    ];

    /*
     * Role profile to get value from ntrust config file.
     */
    protected static $roleProfile = 'user';
}
