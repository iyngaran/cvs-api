<?php


namespace Tests\Unit\User;


use App\Domain\User\Actions\UpdatePermissionAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdatePermissionActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUpdatePermissionActionTest()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'name' => $faker->word
        ];

        $permission = factory(Permission::class)->create();
        $updatedPermission = (new UpdatePermissionAction())->execute($data, $permission->id);
        $this->assertNotNull($updatedPermission->id);
        $this->assertEquals(1, Permission::count());
        $this->assertEquals($data['name'], $updatedPermission->name);
    }
}
