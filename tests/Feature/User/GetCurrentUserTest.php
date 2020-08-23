<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetCurrentUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testGetCurrentUser()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);
        $response = $this->get('/api/me');
        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'user' => [
                            'name',
                            'email',
                            'id',
                            'roles',
                            'extra_permissions'
                        ]
                    ]
                ]
            );
    }

}
