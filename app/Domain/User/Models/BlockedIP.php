<?php


namespace App\Domain\User\Models;


use Illuminate\Database\Eloquent\Model;

class BlockedIP extends Model
{
    protected $table = 'block_ips';
    protected $guarded = [];
}
