<?php


namespace App\Domain\User\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class RoleData extends DataTransferObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var \Spatie\Permission\Models\Permission[]
     */
    public $permissions;

    public static function fromRequest(Request $request): array
    {
        $permissions = [];
        if ($permission_ids = $request->input('data.attributes.permission_ids')) {
            $permissions = Permission::whereIn('id', $permission_ids)->get();
        }

        return ( new self(
            [
                'name' => ucfirst($request->input('data.attributes.name')),
                'permissions' => $permissions
            ]
        )
        )->toArray();
    }

}
