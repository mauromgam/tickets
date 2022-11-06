<?php

namespace Tests\Feature;

use Illuminate\Console\Command;
use Tests\TestCase;

class ProcessTicketsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGenerateTicket()
    {
        $this->artisan('cron:process-tickets')
            ->assertExitCode(Command::SUCCESS);
    }
}
