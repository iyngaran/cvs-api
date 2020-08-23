<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUpdateUser()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $userAcc = factory(User::class)->create();
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

        $response = $this->put('api/users/'.$userAcc->id, $data);
        $response->assertStatus(200)
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
