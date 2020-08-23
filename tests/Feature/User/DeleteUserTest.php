<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteUserTest extends TestCase
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
        $factoryUser = factory(User::class)->create();
        $response = $this->delete('api/users/'.$factoryUser->id);
        $response->assertStatus(204);
    }
}
