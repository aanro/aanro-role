<?php

namespace Someline\Component\Role;


use Someline\Component\Role\Models\Entrust\Permission;
use Someline\Component\Role\Models\Entrust\Role;
use Someline\Models\Foundation\User;

class SomelineRoleService
{

    /**
     * @param $user User|string|'user_id'
     * @param $role Role|string|'role_id'|'role_name'
     * @return mixed
     * @throws \Exception
     */
    public static function addUserRole($user, $role)
    {
        if (!is_object($user)) {
            $user = User::findOrFail($user);
        }

        if (!($user instanceof User)) {
            throw new \Exception('User cannot be used');
        }

        $role = Role::autoGetRole($role);

        if (!$user->hasRole($role->getName())) {
            $user->attachRole($role);
        }

        return $user;
    }

    /**
     * @param $user User|string|'user_id'
     * @param $role Role|string|'role_id'|'role_name'
     * @return mixed
     * @throws \Exception
     */
    public static function removeUserRole($user, $role)
    {
        if (!is_object($user)) {
            $user = User::findOrFail($user);
        }

        if (!($user instanceof User)) {
            throw new \Exception('User cannot be used');
        }

        $role = Role::autoGetRole($role);

        if ($user->hasRole($role->getName())) {
            $user->detachRole($role);
        }

        return $user;
    }

    /**
     * @param $user User|string|'user_id'
     * @param $roles Role|string|'role_id'|'role_name'
     * @throws \Exception
     */
    public static function syncUserRoles($user, $roles)
    {

        if (!is_object($user)) {
            $user = User::findOrFail($user);
        }

        if (!($user instanceof User)) {
            throw new \Exception('User cannot be used');
        }

        $role_ids = [];
        foreach ($roles as $role) {
            $role = Role::autoGetRole($role);
            $role_ids[] = $role->getId();
        }
        $user->roles()->sync($role_ids);

    }

    /**
     * @param $name
     * @param null $display_name
     * @param null $description
     * @return Role
     * @throws \Exception
     */
    public static function addRole($name, $display_name = null, $description = null)
    {
        $role = Role::firstOrCreate([
            'name' => $name,
        ]);
        $role->display_name = $display_name; // optional
        $role->description = $description; // optional
        $role->save();
        if (!$role->exists) {
            throw new \Exception('Failed to create role');
        }
        return $role;
    }

    /**
     * @param $role
     * @return mixed
     */
    public static function deleteRole($role)
    {
        $role = Role::fromName($role);
        return $role->delete();
    }

    /**
     * @param $name
     * @param null $display_name
     * @param null $description
     * @return Permission
     * @throws \Exception
     */
    public static function addPermission($name, $display_name = null, $description = null)
    {
        $permission = Permission::firstOrCreate([
            'name' => $name,
        ]);
        $permission->display_name = $display_name; // optional
        $permission->description = $description; // optional
        $permission->save();
        if (!$permission->exists) {
            throw new \Exception('Failed to create role');
        }
        return $permission;
    }

    /**
     * @param $permission
     * @return bool|null
     */
    public static function deletePermission($permission)
    {
        $permission = Permission::autoGetPermission($permission);
        return $permission->delete();
    }


}