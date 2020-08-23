<?php


namespace App\Domain\Cvs\Actions;


use App\Domain\Cvs\Exceptions\StudentNotFoundException;
use App\Domain\Cvs\Models\Student;

class DeleteStudentAction
{
    public function execute(array $attributes, int $id): bool
    {
        $student = Student::find($id);
        if (!$student) {
            throw new StudentNotFoundException("The Student [".$id."] does not exist.");
        }

        return $student->delete();
    }
}
