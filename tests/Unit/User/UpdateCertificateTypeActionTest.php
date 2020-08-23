<?php


namespace Tests\Unit\User;


use App\Domain\Cvs\Actions\CreateCertificateTypeAction;
use App\Domain\Cvs\Models\CertificateType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCertificateTypeActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUpdateCertificateTypeActionTest()
    {
        $faker = \Faker\Factory::create();
        //$certificateType = factory(CertificateType::class)->create(['name'=>'test']);

        $attributes = [
            'name' => $faker->word
        ];

        $certificateType = (new CreateCertificateTypeAction())->execute($attributes);
        $this->assertNotNull($certificateType->id);
        $this->assertEquals(1, CertificateType::count());
    }
}
