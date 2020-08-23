<?php

namespace Tests\Unit\User;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Domain\User\Repositories\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RetrieveUserRolesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRetrieveUserRoleById()
    {
        $factRole = factory(Role::class)->create();
        factory(Role::class, 3)->create();
        $roleRepository = $this->app->make(RoleRepositoryInterface::class);
        $role = $roleRepository->find($factRole->id);
        $this->assertEquals($factRole->id, $role->id);
        $this->assertEquals($factRole->name, $role->name);
    }

    public function testRetrieveUserRoleByName()
    {
        $factRole = factory(Role::class)->create();
        factory(Role::class, 3)->create();
        $roleRepository = $this->app->make(RoleRepositoryInterface::class);
        $role = $roleRepository->findByName($factRole->name);
        $this->assertEquals($factRole->id, $role->id);
        $this->assertEquals($factRole->name, $role->name);
    }

    public function testRetrieveUserRoles()
    {
        factory(Role::class, 3)->create();
        $roleRepository = $this->app->make(RoleRepositoryInterface::class);
        $roles = $roleRepository->all();
        $this->assertEquals(3, $roles->count());
        $this->assertInstanceOf(Collection::class, $roles);
    }

}
