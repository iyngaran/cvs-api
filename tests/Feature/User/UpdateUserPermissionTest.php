<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdateUserPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testUpdateUserPermission()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $this->withoutExceptionHandling();

        $factoryPermission = factory(Permission::class)->create();
        $faker = \Faker\Factory::create();

        $data = [
            'data' => [
                'attributes' => [
                    "name" => $faker->word
                ]
            ]
        ];

        $response = $this->put('api/user-permissions/' . $factoryPermission->id, $data);
        $response->assertStatus(200)
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
