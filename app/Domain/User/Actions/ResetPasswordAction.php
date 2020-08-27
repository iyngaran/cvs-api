<?php


namespace App\Domain\User\Actions;


use App\User;
use App\Domain\User\Exceptions\UserNotFoundException;
use Illuminate\Support\Carbon;

class ResetPasswordAction
{
    public function execute(array $attributes, int $userId): User
    {
        $user = User::find($userId);
        if (!$user) {
            throw new UserNotFoundException("The user [" . $userId . "] not found");
        }

        if ($attributes['password']) {
            $user->update(
                [
                    'password' => $attributes['password'],
                    'password_change_at' => Carbon::now(),
                ]
            );
        }

        return $user;
    }
}
