<?php

namespace Someline\Component\Role\Models\Entrust;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
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
        return Permission::where([
            'name' => $name,
        ])->first();
    }

    /**
     * @param $permission
     * @return null|Permission
     * @throws \Exception
     */
    public static function autoGetPermission($permission)
    {

        if (!is_object($permission)) {
            if (is_numeric($permission)) {
                $permission = Permission::findOrFail($permission);
            } else {
                $permission = Permission::fromName($permission);
            }
        }

        if (!($permission instanceof Permission)) {
            throw new \Exception('Permission cannot be used');
        }

        return $permission;

    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}