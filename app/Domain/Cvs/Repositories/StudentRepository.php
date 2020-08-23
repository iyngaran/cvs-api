<?php


namespace App\Domain\User\Repositories;


use App\Domain\Cvs\Exceptions\StudentNotFoundException;
use App\Domain\Cvs\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class StudentRepository implements StudentRepositoryInterface
{

    public function find(int $id): ?Student
    {
        $student = Student::find($id);
        if (!$student) {
            throw new StudentNotFoundException("The Student [".$id."] does not exist.");
        }
        return $student;
    }

    public function findByName(string $name): ?Student
    {
        $student = Student::where('name', $name)->first();
        if (!$student) {
            throw new StudentNotFoundException("The Student [".$name."] does not exist.");
        }
        return $student;
    }

    public function search(Request $request): ?LengthAwarePaginator
    {
        $limit = $request->limit;

        // TODO: Implement search() method.
    }

    public function all(Request $request): ?LengthAwarePaginator
    {
        $limit = $request->limit;
        $limit = Config::get('cvs.page_limit',$limit);

        $students = Student::paginate($limit);
        if (!$students) {
            throw new StudentNotFoundException("The students record does not exist.");
        }
        return $students;
    }
}
