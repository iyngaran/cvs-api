<?php


namespace App\Domain\Cvs\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;

class CertificateTypeData extends DataTransferObject
{
    /**
     * @var string
     */
    public $name;

    public static function fromRequest(Request $request): array
    {
        return ( new self(
            [
                'name' => ucfirst($request->input('data.attributes.name'))
            ]
        )
        )->toArray();
    }
}
