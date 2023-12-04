<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name'
    ];

    public function model_has_roles()
    {
        return $this->hasMany(ModelHasRole::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }

    public static function getRoleNames()
    {
        return DB::table('roles')->pluck('name')->toArray();
    }
}
