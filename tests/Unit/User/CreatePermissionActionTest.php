<?php


namespace Tests\Unit\User;


use App\Domain\User\Actions\CreatePermissionAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CreatePermissionActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreatePermissionActionTest()
    {
        $faker = \Faker\Factory::create();

        $attributes = [
            'name' => $faker->word
        ];

        $permission = (new CreatePermissionAction())->execute($attributes);
        $this->assertNotNull($permission->id);
        $this->assertEquals(1, Permission::count());
    }
}
