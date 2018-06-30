<?php

namespace Someline\Component\Role\Models\Entrust;

use Config;
use Someline\Models\Foundation\User;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * @param $name
     * @return Role|null
     */
    public static function fromName($name)
    {
        return Role::where([
            'name' => $name,
        ])->first();
    }

    /**
     * @param $role
     * @return null|Role
     * @throws \Exception
     */
    public static function autoGetRole($role)
    {

        if (!is_object($role)) {
            if (is_numeric($role)) {
                $role = Role::findOrFail($role);
            } else {
                $role = Role::fromName($role);
            }
        }

        if (!($role instanceof Role)) {
            throw new \Exception('Role cannot be used');
        }

        return $role;

    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, Config::get('entrust.role_user_table'), Config::get('entrust.role_foreign_key'), Config::get('entrust.user_foreign_key'));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $permissions
     */
    public function syncPermissions(array $permissions)
    {
        $permissionIds = [];
        foreach ($permissions as $permission) {
            if (is_object($permission)) {
                $permissionIds[] = $permission->getKey();
            } else if (is_array($permission)) {
                $permissionIds[] = $permission['id'];
            } else {
                $permissionIds[] = $permission;
            }
        }
        $this->savePermissions($permissionIds);
    }

}