<?php

namespace Tests\Unit\User;


use App\Domain\User\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class RetrieveUsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRetrieveUserById()
    {
        $factUser = factory(User::class)->create();
        factory(User::class, 3)->create();
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $user = $userRepository->find($factUser->id);
        $this->assertEquals($factUser->id, $user->id);
        $this->assertEquals($factUser->name, $user->name);
    }

    public function testRetrieveUserByEmail()
    {
        $factUser = factory(User::class)->create();
        factory(User::class, 3)->create();
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $user = $userRepository->findByEmail($factUser->email);
        $this->assertEquals($factUser->id, $user->id);
        $this->assertEquals($factUser->name, $user->name);
    }

    public function testRetrieveUsers()
    {
        factory(User::class, 5)->create();
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $users = $userRepository->all();
        $this->assertEquals(5, $users->count());
        $this->assertInstanceOf(Collection::class, $users);
    }

}
