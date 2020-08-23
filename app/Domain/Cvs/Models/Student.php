<?php

namespace App\Domain\Cvs\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];


    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
