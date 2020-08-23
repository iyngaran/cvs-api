<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\RoleCollection;
use App\Http\Resources\User\PermissionCollection;

class User extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'user',
                'user_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'roles' => new RoleCollection($this->roles),
                    'extra_permissions' => new PermissionCollection($this->getDirectPermissions()),
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ],
                'links' => [
                    'self' => url("api/users/" . $this->id),
                ]
            ]
        ];
    }
}
