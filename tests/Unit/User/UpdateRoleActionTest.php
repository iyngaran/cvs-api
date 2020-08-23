<?php

namespace Tests\Unit\User;

use App\Domain\User\Actions\UpdateRoleAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateRoleActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUpdateRoleActionTest()
    {
        $faker = \Faker\Factory::create();
        $role = factory(Role::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        $attributes = [
            'name' => $faker->word,
            'permissions' => $permissions
        ];

        $role = (new UpdateRoleAction())->execute($attributes,$role->id);
        $this->assertNotNull($role->id);
        $this->assertEquals(3, $role->permissions()->count());
        $this->assertEquals(1, Role::count());
        $this->assertNotNull($role->permissions());
        $this->assertTrue($role->hasPermissionTo($permissions[0]->name));
    }
}
