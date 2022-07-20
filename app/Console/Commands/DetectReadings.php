<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Src\Reading\Application\DetectReadingUseCase;
use Src\Reading\Application\GetMedianUseCase;
use Src\Reading\Application\ReadFileUseCase;
use Src\Reading\Domain\Exceptions\ExtensionNotFound;
use Src\Reading\Infrastructure\CsvReaderController;
use Src\Reading\Infrastructure\XmlReaderController;

class DetectReadings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'readings:detect {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detect suplicious readings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileName = $this->argument('fileName');

        $path = Storage::disk('local')->path('public/readings/' . $fileName);

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        match ($extension) {
            'csv' => $reader = new CsvReaderController(),
            'xml' => $reader = new XmlReaderController(),
            default => throw new ExtensionNotFound('File not found'),
        };

        $readerUseCase = new ReadFileUseCase($reader);

        $readings = $readerUseCase->execute($path);

        $medianUseCase = new GetMedianUseCase();
        $median = $medianUseCase->execute($readings);

        $detectReadingUseCase = new DetectReadingUseCase();
        $suplicious_readings = $detectReadingUseCase->execute($readings, $median);

        // Print to table

        return 1;
    }
}
