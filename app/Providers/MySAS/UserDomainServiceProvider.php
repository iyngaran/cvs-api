<?php


namespace App\Providers\MySAS;

use App\Domain\User\Repositories\PermissionRepository;
use App\Domain\User\Repositories\PermissionRepositoryInterface;
use App\Domain\User\Repositories\RoleRepository;
use App\Domain\User\Repositories\RoleRepositoryInterface;
use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UserDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }


    public function boot()
    {
        //
    }
}
