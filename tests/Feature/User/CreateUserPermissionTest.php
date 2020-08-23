<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateUserPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testCreateUserPermission()
    {
        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();

        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $data = [
            'data' => [
                'attributes' => [
                    'name' => $faker->word
                ]
            ]
        ];

        $response = $this->post('api/user-permissions', $data);
        $response->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'type',
                        'permission_id',
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
