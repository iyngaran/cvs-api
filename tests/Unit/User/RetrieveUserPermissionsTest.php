<?php


namespace Tests\Unit\User;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use App\Domain\User\Repositories\PermissionRepositoryInterface;

class RetrieveUserPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRetrieveUserPermissionById()
    {
        $factPermission = factory(Permission::class)->create();
        factory(Permission::class, 3)->create();
        $permissionRepository = $this->app->make(PermissionRepositoryInterface::class);
        $permission = $permissionRepository->find($factPermission->id);
        $this->assertEquals($factPermission->id, $permission->id);
        $this->assertEquals($factPermission->name, $permission->name);
    }

    public function testRetrieveUserPermissionByName()
    {
        $factPermission = factory(Permission::class)->create();
        factory(Permission::class, 3)->create();
        $permissionRepository = $this->app->make(PermissionRepositoryInterface::class);
        $permission = $permissionRepository->findByName($factPermission->name);
        $this->assertEquals($factPermission->id, $permission->id);
        $this->assertEquals($factPermission->name, $permission->name);
    }

    public function testRetrieveUserPermissions()
    {
        factory(Permission::class, 5)->create();
        $permissionRepository = $this->app->make(PermissionRepositoryInterface::class);
        $permission = $permissionRepository->all();
        $this->assertEquals(5, $permission->count());
        $this->assertInstanceOf(Collection::class, $permission);
    }

}
