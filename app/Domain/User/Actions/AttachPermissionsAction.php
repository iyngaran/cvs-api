<?php


namespace App\Domain\User\Actions;


use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class AttachPermissionsAction
{
    public function execute(Role $role, Collection $permissions): Role
    {
        $role->syncPermissions($permissions);
        return $role;
    }
}
