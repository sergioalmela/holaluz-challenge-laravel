<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Src\Reading\Application\AddMediansIntoReadingsUseCase;
use Src\Reading\Application\DetectReadingsUseCase;
use Src\Reading\Application\GetMedianUseCase;
use Src\Reading\Application\ReadFileUseCase;
use Src\Reading\Domain\Exceptions\ExtensionNotFound;
use Src\Reading\Domain\Exceptions\FileNotExists;
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
        try {
            // Get the file contents
            $path = Storage::disk('local')->path('public/readings/' . $this->argument('fileName'));

            match (pathinfo($path, PATHINFO_EXTENSION)) {
                'csv' => $reader = new CsvReaderController(),
                'xml' => $reader = new XmlReaderController(),
                default => throw new ExtensionNotFound("Please, provide a valid file extension"),
            };

            if (!file_exists($path)) {
                throw new FileNotExists('File not found');
            }

            $readerUseCase = new ReadFileUseCase($reader);

            $readings = $readerUseCase->execute($path);

            // Get medians
            $medianUseCase = new GetMedianUseCase();
            $medians = $medianUseCase->execute($readings);

            // Detect
            $detectUseCase = new DetectReadingsUseCase();
            $suspicious_readings = $detectUseCase->execute($readings, $medians);

            // Print results
            $headers = ['Client', 'Month', 'Suspicious', 'Median'];

            $table = [];
            foreach ($suspicious_readings as $reading) {
                $table[] = [
                    $reading->getId()->value(),
                    $reading->getPeriod()->month(),
                    $reading->getReading()->value(),
                    $medians[$reading->getId()->value()]->value(),
                ];
            }

            $this->table($headers, $table);

            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return 1;
        }
    }
}
