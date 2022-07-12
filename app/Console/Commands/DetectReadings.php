<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        return 0;
    }
}
