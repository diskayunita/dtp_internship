<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    protected $fillable = ['name', 'display_name', 'description'];

	public function permissions()
	{
	    return $this->belongsToMany('App\Permission');
	}

	public function permission_roles()
	{
		return $this->hasMany('App\PermissionRole', 'role_id');
	}
}
