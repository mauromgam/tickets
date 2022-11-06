<?php

namespace Tests\Unit;

use Illuminate\Console\Command;
use Tests\TestCase;

class KernelScheduleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Model()
    {
        $this->artisan('schedule:run')
            ->assertExitCode(Command::SUCCESS);
    }
}
