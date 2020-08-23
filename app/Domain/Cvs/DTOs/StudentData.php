<?php


namespace App\Domain\Cvs\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;

class StudentData extends DataTransferObject
{
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $dateOfBirth;

    /**
     * @var string
     */
    public $nic;

    /**
     * @var string
     */
    public $passport;

    /**
     * @var string
     */
    public $registrationNo;

    public static function fromRequest(Request $request): array
    {
        return ( new self(
            [
                'firstName' => ucfirst($request->input('data.attributes.first_name')),
                'lastName' => ucfirst($request->input('data.attributes.last_name')),
                'dateOfBirth' => ucfirst($request->input('data.attributes.date_of_birth')),
                'nic' => ucfirst($request->input('data.attributes.nic')),
                'passport' => ucfirst($request->input('data.attributes.passport'))
            ]
        )
        )->toArray();
    }
}
