<?php


namespace App\Domain\Cvs\Actions;


use App\Domain\Cvs\Models\Student;

class CreateStudentAction
{
    public function execute(array $attributes): Student
    {
        return Student::create(
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
