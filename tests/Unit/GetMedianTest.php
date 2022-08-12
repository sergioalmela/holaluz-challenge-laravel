<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Src\Reading\Application\GetMedianUseCase;
use Src\Reading\Application\ReadFileUseCase;
use Src\Reading\Infrastructure\CsvReaderController;
use Tests\TestCase;

class GetMedianTest extends TestCase
{
    /**
     * Check if the median is correct.
     *
     * @return void
     */
    public function test_median_has_values()
    {
        $path = Storage::disk('local')->path('public/readings/2016-readings.csv');

        $readerUseCase = new ReadFileUseCase(new CsvReaderController());

        $readings = $readerUseCase->execute($path);

        $medianUseCase = new GetMedianUseCase();
        $medians = $medianUseCase->execute($readings);
        $median = reset($medians);

        $this->assertNotEmpty($medians);
        $this->assertIsArray($medians);
        $this->assertNotEmpty($median);
        $this->assertObjectHasAttribute('median', $median);
        $this->assertIsInt($median->value());
        $this->assertTrue($median->value() > 0, 'Median value must be greater than 0');
    }
}
