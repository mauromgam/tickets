<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class GenerateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:generate-ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates 1 ticket with dummy data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Ticket::factory()
            ->count(1)
            ->create();

        return self::SUCCESS;
    }
}
