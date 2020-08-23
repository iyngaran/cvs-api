<?php

namespace Tests\Unit\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Domain\User\DTOs\UserData;


class UserDataTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUserData()
    {
        $faker = \Faker\Factory::create();
        $roles = factory(Role::class, 3)->create();
        $permissions = factory(Permission::class, 3)->create();
        $role_ids = $roles->pluck('id');
        $permission_ids = $permissions->pluck('id');

        $data = [
            'data' => [
                'attributes' => [
                    "name" => $faker->name,
                    "email" => $faker->email,
                    "password" => $faker->password,
                    "role_ids" => $role_ids,
                    "exta_permission_ids" => $permission_ids,
                ]
            ]
        ];
        $request = new \Illuminate\Http\Request($data);
        $userData = UserData::fromRequest($request);
        $this->assertArrayHasKey('name', $userData);
        $this->assertArrayHasKey('email', $userData);
        $this->assertArrayHasKey('password', $userData);
        $this->assertArrayHasKey('roles', $userData);
        $this->assertArrayHasKey('extraPermissions', $userData);
    }
}
