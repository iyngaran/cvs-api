<?php


namespace App\Domain\User\Actions;


use Spatie\Permission\Models\Permission;
use App\Domain\User\Exceptions\PermissionNotFoundException;

class UpdatePermissionAction
{
    public function execute(array $attributes, int $id): Permission
    {
        $permission = Permission::find($id);
        if (!$permission) {
            throw new PermissionNotFoundException("The Permission id # ".$id." not found");
        }

        $permission->update(
            [
                'name' => $attributes['name']
            ]
        );

        return $permission;
    }
}
