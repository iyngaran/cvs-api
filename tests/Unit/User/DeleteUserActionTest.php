<?php

namespace Tests\Unit\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\User\Actions\DeleteUserAction;

class DeleteUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testDeleteUserActionTest()
    {
        $user = factory(User::class)->create();
        $res = (new DeleteUserAction())->execute($user->id);
        $this->assertEquals(0, User::count());
        $this->assertTrue($res);
    }
}
