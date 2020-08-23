<?php


namespace App\Domain\User\DTOs;


use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserData extends DataTransferObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var \Spatie\Permission\Models\Role[]
     */
    public $roles;

    /**
     * @var \Spatie\Permission\Models\Permission[]
     */
    public $extraPermissions;

    public static function fromRequest(Request $request): array
    {
        $roles = [];
        if ($role_ids = $request->input('data.attributes.role_ids')) {
            $roles = Role::whereIn('id', $role_ids)->get();
        }

        $extraPermissions = [];
        if ($extra_permission_ids = $request->input('data.attributes.extra_permission_ids')) {
            $extraPermissions = Permission::whereIn('id', $extra_permission_ids)->get();
        }

        return (new self(
            [
                'name' => ucfirst($request->input('data.attributes.name')),
                'email' => $request->input('data.attributes.email'),
                'password' => $request->input('data.attributes.password'),
                'roles' => $roles,
                'extraPermissions' => $extraPermissions
            ]
        )
        )->toArray();
    }

}
