<?php


namespace App\Domain\User\Repositories;


use App\Domain\Cvs\Exceptions\CertificateTypeNotFoundException;
use App\Domain\Cvs\Models\CertificateType;
use Illuminate\Database\Eloquent\Collection;

class CertificateTypeRepository implements CertificateTypeRepositoryInterface
{

    public function find(int $id): ?CertificateType
    {
        $certificateType = CertificateType::find($id);
        if (!$certificateType) {
            throw new CertificateTypeNotFoundException("The CertificateType [".$id."] does not exist.");
        }
        return $certificateType;
    }

    public function findByName(string $name): ?CertificateType
    {
        $certificateType = CertificateType::where('name', $name)->first();
        if (!$certificateType) {
            throw new CertificateTypeNotFoundException("The CertificateType [".$name."] does not exist.");
        }
        return $certificateType;
    }

    public function all(): ?Collection
    {
        return CertificateType::all();
    }
}
