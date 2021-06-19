<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('permission_name', $permission)->count();
    }
}
