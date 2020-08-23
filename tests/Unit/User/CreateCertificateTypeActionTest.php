<?php


namespace Tests\Unit\User;


use App\Domain\Cvs\Actions\CreateCertificateTypeAction;
use App\Domain\Cvs\Models\CertificateType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCertificateTypeActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateCertificateTypeActionTest()
    {
        $faker = \Faker\Factory::create();

        $attributes = [
            'name' => $faker->word
        ];

        $certificateType = (new CreateCertificateTypeAction())->execute($attributes);
        $this->assertNotNull($certificateType->id);
        $this->assertEquals(1, CertificateType::count());
    }
}
