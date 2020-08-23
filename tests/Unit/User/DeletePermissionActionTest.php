<?php


namespace Tests\Unit\User;


use App\Domain\User\Actions\DeletePermissionAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeletePermissionActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testDeletePermissionAction()
    {
        $permission = factory(Permission::class)->create();
        $deletePermission = (new DeletePermissionAction())->execute($permission->id);
        $this->assertTrue($deletePermission);
        $this->assertEquals(0, Permission::count());
    }
}
