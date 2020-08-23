<?php


namespace App\Domain\Cvs\Actions;

use App\Domain\Cvs\Models\CertificateType;

class CreateCertificateTypeAction
{
    public function execute(array $attributes): CertificateType
    {
        return CertificateType::create(
            [
                'name' => $attributes['name'],
            ]
        );
    }
}
