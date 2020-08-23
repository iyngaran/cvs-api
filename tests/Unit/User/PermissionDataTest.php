<?php

namespace Tests\Unit\User;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\User\DTOs\PermissionData;

class PermissionDataTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testPermissionData()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'data' => [
                'attributes' => [
                    "name" => $faker->word
                ]
            ]
        ];

        $request = new \Illuminate\Http\Request($data);
        $permissionData = PermissionData::fromRequest($request);
        $this->assertArrayHasKey('name', $permissionData);
    }
}
