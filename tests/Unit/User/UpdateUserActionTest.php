<?php

namespace Tests\Unit\User;

use App\Domain\User\Actions\UpdateUserAction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function testUpdateUserActionTest()
    {
        $faker = \Faker\Factory::create();
        $factoryUser = factory(User::class)->create();
        $roles = factory(Role::class, 3)->create();
        $permissions = factory(Permission::class, 4)->create();

        $attributes = [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
            'roles' => $roles,
            'extraPermissions' => $permissions
        ];

        $user = (new UpdateUserAction())->execute($attributes, $factoryUser->id);
        $this->assertNotNull($user->id);
        $this->assertEquals(1, User::count());
        $this->assertEquals(3, $user->roles()->count());
        $this->assertEquals(4, $user->getDirectPermissions()->count());
        $this->assertEquals($roles->pluck('name'), $user->getRoleNames());
        $this->assertEquals($permissions->pluck('name'), $user->getPermissionNames());
    }
}
