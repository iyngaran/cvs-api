<?php


namespace App\Domain\Cvs\Actions;


use App\Domain\Cvs\Exceptions\StudentNotFoundException;
use App\Domain\Cvs\Models\Student;

class UpdateStudentAction
{
    public function execute(array $attributes, int $id): bool
    {
        $student = Student::find($id);
        if (!$student) {
            throw new StudentNotFoundException("The Student [".$id."] does not exist.");
        }

        return $student->update(
            [
                'first_name' => $attributes['firstName'],
                'last_name' => $attributes['lastName'],
                'date_of_birth' => $attributes['dateOfBirth'],
                'nic' => $attributes['nic'],
                'passport' => $attributes['passport'],
                'registration_no' => $attributes['registrationNo'],
            ]
        );
    }
}
