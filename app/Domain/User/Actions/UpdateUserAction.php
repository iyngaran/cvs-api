<?php


namespace App\Domain\User\Actions;


use App\User;
use App\Domain\User\Exceptions\UserNotFoundException;

class UpdateUserAction
{
    public function execute(array $attributes, int $userId): User
    {
        $user = User::find($userId);
        if (!$user) {
            throw new UserNotFoundException("The user [" . $userId . "] not found");
        }

        $user->update(
            [
                'name' => $attributes['name'],
                'email' => $attributes['email']
            ]
        );

        if ($attributes['password']) {
            $user->update(
                [
                    'password' => $attributes['password'],
                ]
            );
        }

        if ($attributes['roles']) {
            $user->syncRoles($attributes['roles']);
        }

        if ($attributes['extraPermissions']) {
            $user->syncPermissions($attributes['extraPermissions']);
        }


        return $user;
    }
}
