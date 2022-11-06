<?php

namespace Tests\Feature;

use Illuminate\Console\Command;
use Tests\TestCase;

class PassportCheckKeysTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGenerateTicket()
    {
        $this->artisan('passport:check-keys')
            ->assertExitCode(Command::SUCCESS);
    }
}
