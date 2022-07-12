<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class XmlReaderTest extends TestCase
{
    /**
     * Check if command returns ok
     *
     * @return void
     */
    public function test_csv_command_returns_ok()
    {
        $this->artisan('readings:detect 2016-readings.xml')
            ->assertExitCode(0);
    }

    /**
     * Check if command returns not found
     *
     * @return void
     */
    public function test_csv_command_returns_not_found()
    {
        $this->artisan('readings:detect not-found.xml')
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
