<?php


namespace App\Domain\User\Repositories;


use App\Domain\Cvs\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface StudentRepositoryInterface
{
    public function find(int $id): ? Student;
    public function findByName(string $name): ? Student;
    public function search(Request $request): ? LengthAwarePaginator;
    public function all(Request $request): ? LengthAwarePaginator;
}
