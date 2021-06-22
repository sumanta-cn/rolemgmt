<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use App\Models\UserDetails;
use App\Models\StudentDetails;

trait HasRolesAndPermissions
{
    /**
    * @return mixed
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    /**
    * @param mixed ...$roles
    * @return bool
    */
    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('role_name', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
    * @param $permission
    * @return bool
    */
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return is_object($permission) ? (bool) $this->permissions->where('permission_name', $permission->permission_name)->count() : (bool) $this->permissions->where('permission_name', $permission)->count();
    }

    /**
    * @param $permission
    * @return bool
    */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * @param array $permissions
     * @return mixed
     */
    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('permission_name',$permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function userdetails() {

        return $this->hasOne(UserDetails::class);
    }

    public function studentdetails() {

        return $this->hasOne(StudentDetails::class);
    }
}
