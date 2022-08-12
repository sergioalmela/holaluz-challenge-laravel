<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Src\Reading\Application\ReadFileUseCase;
use Src\Reading\Domain\Entities\ReaderEntity;
use Src\Reading\Domain\ValueObjects\ClientId;
use Src\Reading\Domain\ValueObjects\Period;
use Src\Reading\Domain\ValueObjects\Reading;
use Src\Reading\Infrastructure\CsvReaderController;
use Tests\TestCase;

class ReadFileTest extends TestCase
{
    /**
     * Test if the file is read correctly.
     *
     * @return void
     */
    public function test_readings_attributes()
    {
        $path = Storage::disk('local')->path('public/readings/2016-readings.csv');

        $readerUseCase = new ReadFileUseCase(new CsvReaderController());

        $readings = $readerUseCase->execute($path);
        $reading = reset($readings);

        $this->assertNotEmpty($readings);
        $this->assertObjectHasAttribute('id', $reading);
        $this->assertObjectHasAttribute('period', $reading);
        $this->assertObjectHasAttribute('reading', $reading);

        $this->assertInstanceOf(ReaderEntity::class, $reading);

        $this->assertInstanceOf(ClientId::class, $reading->id());
        $this->assertInstanceOf(Period::class, $reading->period());
        $this->assertInstanceOf(Reading::class, $reading->reading());
    }
}
