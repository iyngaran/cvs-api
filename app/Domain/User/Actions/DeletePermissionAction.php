<?php


namespace App\Domain\User\Actions;

use App\Domain\User\Exceptions\PermissionNotFoundException;
use Spatie\Permission\Models\Permission;

class DeletePermissionAction
{
    public function execute(int $id) : bool
    {
        $permission = Permission::find($id);

        if (!$permission) {
            throw new PermissionNotFoundException("The permission id # ".$id." not found");
        } else {
            return $permission->delete();
        }
        return null;
    }
}
