<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class ProcessTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:process-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process 5 tickets every 5 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Processing tickets...');

        $tickets = Ticket::where('status', '=', false)
            ->orderBy('created_at')
            ->limit(5)
            ->get();

        /** @var Ticket $ticket */
        foreach ($tickets as $ticket) {
            $ticket->status = true;
            $ticket->save();
        }

        $this->info($tickets->count() . ' tickets processed successfully');

        return self::SUCCESS;
    }
}
