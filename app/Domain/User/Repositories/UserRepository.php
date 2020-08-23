<?php


namespace App\Domain\User\Repositories;


use App\Domain\User\Exceptions\UserNotFoundException;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function find(int $id): ?User
    {
        $user = User::find($id);
        if (!$user) {
            throw new UserNotFoundException("The user [" . $id . "] not found");
        }
        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new UserNotFoundException("The user [" . $email . "] not found");
        }
        return $user;
    }

    public function all(): ?Collection
    {
        return User::all();
    }

    public function findWithRolesAndPermissions(int $id): ?User
    {
        $user = User::with('roles','extraPermissions')->find($id);
        if (!$user) {
            throw new UserNotFoundException("The user [" . $id . "] not found");
        }
        return $user;
    }
}
