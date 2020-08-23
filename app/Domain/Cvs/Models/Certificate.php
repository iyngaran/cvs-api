<?php

namespace App\Domain\Cvs\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';
    protected $guarded = [];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function certificateType()
    {
        return $this->belongsTo(CertificateType::class);
    }
}
