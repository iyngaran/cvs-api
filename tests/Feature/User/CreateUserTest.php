<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateUser()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $roles = factory(Role::class, 3)->create();
        $role_ids = $roles->pluck('id');

        $extraPermissions = factory(Permission::class, 2)->create();
        $exta_permission_ids = $extraPermissions->pluck('id');

        $data = [
            'data' => [
                'attributes' => [
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => $faker->password,
                    'role_ids' => $role_ids,
                    'extra_permission_ids' => $exta_permission_ids
                ]
            ]
        ];

        $response = $this->post('api/users', $data);
        $response->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'type',
                        'user_id',
                        'attributes' => [
                            'id',
                            'name',
                            'email',
                            'roles',
                            'extra_permissions',
                            'created_at',
                            'updated_at'
                        ],
                        'links' => [
                            'self'
                        ]
                    ]
                ]
            );
    }
}
