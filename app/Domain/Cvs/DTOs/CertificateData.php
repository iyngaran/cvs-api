<?php


namespace App\Domain\Cvs\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;

class CertificateData extends DataTransferObject
{
    /**
     * @var \App\Domain\Cvs\Models\CertificateType
     */
    public $certificateType;

    /**
     * @var \App\Domain\Cvs\Models\Student
     */
    public $student;

    /**
     * @var string
     */
    public $fromDate;

    /**
     * @var string
     */
    public $toDate;

    /**
     * @var string
     */
    public $grade;

    /**
     * @var string
     */
    public $certificateNo;

    public static function fromRequest(Request $request): array
    {
        $certificateType = $request->input('data.attributes.certificate_type');
        $student = $request->input('data.attributes.student');

        return (new self(
            [
                'certificateType' => $certificateType,
                'student' => $student,
                'fromDate' => $request->input('data.attributes.from_date'),
                'toDate' => $request->input('data.attributes.to_date'),
                'grade' => $request->input('data.attributes.grade'),
                'certificateNo' => $request->input('data.attributes.certificate_no'),
            ]
        )
        )->toArray();
    }
}
