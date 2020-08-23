<?php

namespace Tests\Unit\User;

use App\Domain\User\Actions\CreateRoleAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateRoleActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateRoleActionTest()
    {
        $faker = \Faker\Factory::create();
        $permissions = factory(Permission::class, 3)->create();

        $attributes = [
            'name' => $faker->word,
            'permissions' => $permissions
        ];

        $role = (new CreateRoleAction())->execute($attributes);
        $this->assertNotNull($role->id);
        $this->assertEquals(1, Role::count());
        $this->assertNotNull($role->permissions());
        $this->assertTrue($role->hasPermissionTo($permissions[0]->name));
    }
}
