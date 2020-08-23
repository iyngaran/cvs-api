<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteUserPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testDeleteUserPermission()
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

        $response = $this->delete('api/user-permissions/'.$factoryPermission->id);
        $response->assertStatus(204);
    }
}
