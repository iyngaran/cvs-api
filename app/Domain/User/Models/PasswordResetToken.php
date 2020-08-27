<?php


namespace App\Domain\User\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';
    protected $guarded = [];

    public function tokenable() {
        $this->morphTo();
    }
}
