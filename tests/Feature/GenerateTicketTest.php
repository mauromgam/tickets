<?php

namespace Tests\Feature;

use Illuminate\Console\Command;
use Tests\TestCase;

class GenerateTicketTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGenerateTicket()
    {
        $this->artisan('cron:generate-ticket')
            ->assertNotExitCode(Command::FAILURE)
            ->assertExitCode(Command::SUCCESS);
    }
}
