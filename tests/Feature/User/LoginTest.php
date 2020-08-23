<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUserCanLoginToTheSystem()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $user_email = $user->email;

        $response = $this->post(
            '/api/login',
            [
                'data' => [
                    'attributes' => [
                        "email" => $user_email,
                        "password" => 'password',
                        "device_name" => "Web"
                    ]
                ]
            ]
        );

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
                        ],
                        'token'
                    ]
                ]
            );

    }

}
