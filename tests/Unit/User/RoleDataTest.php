<?php

namespace Tests\Unit\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use App\Domain\User\DTOs\PermissionData;
use App\Domain\User\DTOs\RoleData;

class RoleDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRoleData()
    {
        $faker = \Faker\Factory::create();
        $permissions = factory(Permission::class, 3)->create();
        $permission_ids = $permissions->pluck('id');

        $data = [
            'data' => [
                'attributes' => [
                    "name" => $faker->word,
                    "permission_ids" => $permission_ids
                ]
            ]
        ];
        $request = new \Illuminate\Http\Request($data);
        $roleData = RoleData::fromRequest($request);
        $this->assertArrayHasKey('name', $roleData);
        $this->assertArrayHasKey('permissions', $roleData);
    }
}
