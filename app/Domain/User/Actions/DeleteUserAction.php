<?php


namespace App\Domain\User\Actions;

use App\Domain\User\Exceptions\UserNotFoundException;
use App\User;

class DeleteUserAction
{
    public function execute(int $id) : bool
    {
        $user = User::find($id);
        if (!$user) {
            throw new UserNotFoundException("The user [" . $id . "] not found");
        }
        return $user->delete();
    }
}
