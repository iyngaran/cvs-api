<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CreateUserRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testCreateUserRole()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $permissions = factory(Permission::class)->create();
        $permission_ids = $permissions->pluck('id');

        $data = [
            'data' => [
                'attributes' => [
                    'name' => $faker->word,
                    'permission_ids' => $permission_ids
                ]
            ]
        ];

        $response = $this->post('api/user-roles', $data);
        $response->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'type',
                        'role_id',
                        'attributes' => [
                            'id',
                            'name',
                            'permissions',
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
