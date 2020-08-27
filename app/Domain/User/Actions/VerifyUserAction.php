<?php


namespace App\Domain\User\Actions;


use App\Domain\User\Exceptions\UserNotFoundException;
use App\User;

class VerifyUserAction
{
    public function execute(User $user) : bool
    {
        if (!$user) {
            throw new UserNotFoundException("The user does not exists");
        }
        return $user->markEmailAsVerified();
    }
}
