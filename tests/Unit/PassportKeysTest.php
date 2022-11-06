<?php

namespace Tests\Unit;

use Illuminate\Console\Command;
use Tests\TestCase;

class PassportKeysTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_DeleteAndRecreateKeys()
    {
        shell_exec('rm -f storage/*.key');

        $this->artisan('passport:check-keys')
            ->assertExitCode(Command::SUCCESS);
    }
}
