<?php


namespace App\Domain\User\Actions;


use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RevokePermissionsAction
{
    public function execute(Role $role): Role
    {
        if ($role->permissions()) {
            $role->revokePermissionTo($role->getPermissionNames());
        }
        return $role;
    }
}
