<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Src\Reading\Application\DetectReadingsUseCase;
use Src\Reading\Application\GetMedianUseCase;
use Src\Reading\Application\ReadFileUseCase;
use Src\Reading\Domain\Entities\ReaderEntity;
use Src\Reading\Domain\ValueObjects\ClientId;
use Src\Reading\Domain\ValueObjects\Period;
use Src\Reading\Domain\ValueObjects\Reading;
use Src\Reading\Infrastructure\CsvReaderController;
use Tests\TestCase;

class DetectReadingsTest extends TestCase
{
    /**
     * Detect the suplicious values in the readings.
     *
     * @return void
     */
    public function test_detect_suplicious_values()
    {
        $path = Storage::disk('local')->path('public/readings/2016-readings.csv');

        $readerUseCase = new ReadFileUseCase(new CsvReaderController());

        $readings = $readerUseCase->execute($path);

        $medianUseCase = new GetMedianUseCase();
        $median = $medianUseCase->execute($readings);

        $detectUseCase = new DetectReadingsUseCase();
        $suspicious_readings = $detectUseCase->execute($readings, $median);

        $this->assertNotEmpty($suspicious_readings);
        $this->assertObjectHasAttribute('id', reset($suspicious_readings));
        $this->assertObjectHasAttribute('period', reset($suspicious_readings));
        $this->assertObjectHasAttribute('reading', reset($suspicious_readings));

        $this->assertInstanceOf(ReaderEntity::class, reset($suspicious_readings));

        $this->assertInstanceOf(ClientId::class, reset($suspicious_readings)->id());
        $this->assertInstanceOf(Period::class, reset($suspicious_readings)->period());
        $this->assertInstanceOf(Reading::class, reset($suspicious_readings)->reading());
    }
}
