<?php


namespace App\Domain\User\Repositories;


use App\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;

    public function findWithRolesAndPermissions(int $id): ?User;

    public function findByEmail(string $name): ?User;

    public function all(): ?Collection;
}
