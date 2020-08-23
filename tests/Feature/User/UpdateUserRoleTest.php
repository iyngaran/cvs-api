<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class UpdateUserRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testUpdateUserRole()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $this->withoutExceptionHandling();

        $factoryRole = factory(Role::class)->create();
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

        $response = $this->put('api/user-roles/' . $factoryRole->id, $data);
        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'type',
                        'role_id',
                        'attributes' => [
                            'id',
                            'name',
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
