<?php


namespace App\Domain\User\Actions;


use Spatie\Permission\Models\Permission;

class CreatePermissionAction
{
    public function execute(array $attributes) : Permission
    {
        return Permission::create(
            [
                'name' => $attributes['name'],
                'guard_name' => 'api'
            ]
        );
    }
}
