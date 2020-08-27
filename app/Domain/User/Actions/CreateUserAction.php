<?php


namespace App\Domain\User\Actions;


use App\User;

class CreateUserAction
{
    public function execute(array $attributes) : User
    {
        $user = User::create(
            [
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => $attributes['password'],
            ]
        );

        $user->assignRole($attributes['roles']);
        $user->givePermissionTo($attributes['extraPermissions']);
        $user->sendEmailVerificationNotification();
        return $user;
    }
}
