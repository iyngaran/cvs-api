<?php


namespace App\Domain\Cvs\Actions;

use App\Domain\Cvs\Exceptions\CertificateNotFoundException;
use App\Domain\Cvs\Models\CertificateType;

class UpdateCertificateTypeAction
{
    public function execute(array $attributes, int $id): bool
    {
        $certificateType = CertificateType::find($id);
        if (!$certificateType) {
            throw new CertificateNotFoundException("The Role [".$id."] does not exist.");
        }

        return $certificateType->update(
            [
                'name' => $attributes['name']
            ]
        );
    }
}
