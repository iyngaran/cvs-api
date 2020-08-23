<?php


namespace App\Domain\User\Repositories;


use App\Domain\Cvs\Models\CertificateType;
use Illuminate\Database\Eloquent\Collection;

interface CertificateTypeRepositoryInterface
{
    public function find(int $id): ? CertificateType;
    public function findByName(string $name): ? CertificateType;
    public function all(): ? Collection;
}
