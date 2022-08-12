<?php

namespace Tests\Feature;

use Tests\TestCase;

class CsvReaderTest extends TestCase
{
    /**
     * Check if command returns ok
     *
     * @return void
     */
    public function test_csv_command_returns_ok()
    {
        $this->artisan('readings:detect 2016-readings.csv')
            ->assertExitCode(0);
    }

    /**
     * Check if command returns not found
     *
     * @return void
     */
    public function test_csv_command_returns_not_found()
    {
        $this->artisan('readings:detect not-found.csv')
            ->expectsOutput("File not found")
            ->assertExitCode(1);
    }

    /**
     * Check if command returns invalid extension
     *
     * @return void
     */
    public function test_csv_command_returns_invalid_extension()
    {
        $this->artisan('readings:detect 2016-readings.doc')
            ->expectsOutput("Please, provide a valid file extension")
            ->assertExitCode(1);
    }
}
