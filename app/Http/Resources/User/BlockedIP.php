<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\RoleCollection;
use App\Http\Resources\User\PermissionCollection;

class BlockedIP extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'user',
                'user_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'ip' => $this->ip,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ],
                'links' => [
                    'self' => url("api/block-user/" . $this->id),
                ]
            ]
        ];
    }
}
