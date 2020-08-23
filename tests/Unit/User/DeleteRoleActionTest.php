<?php

namespace Tests\Unit\User;


use App\Domain\User\Actions\DeleteRoleAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class DeleteRoleActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDeleteRoleActionTest()
    {
        $role = factory(Role::class)->create();
        $role = (new DeleteRoleAction())->execute($role->id);
        $this->assertEquals(0, Role::count());
        $this->assertNull($role);
    }
}
