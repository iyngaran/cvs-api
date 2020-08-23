<?php

namespace App\Domain\Cvs\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    protected $table = 'certificate_types';
    protected $guarded = [];

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
