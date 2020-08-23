<?php


namespace App\Domain\User\Actions;


use App\Domain\User\Exceptions\RoleNotFoundException;
use Spatie\Permission\Models\Role;

class DeleteRoleAction
{
    public function execute(int $roleId):? Role
    {
        $role = Role::find($roleId);
        if (!$role) {
            throw new RoleNotFoundException("The Role [" . $roleId . "] does not exist.");
        }
        (new RevokePermissionsAction())->execute($role);
        $role->delete();
        return null;
    }
}
