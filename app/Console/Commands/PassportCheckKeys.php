<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PassportCheckKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:check-keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created passport keys if they do not exist.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (!file_exists(storage_path('oauth-private.key'))) {
            $this->call('passport:keys');
        }

        $this->line(shell_exec('ls -la storage/*.key'));

        // Update file permissions
        chmod(storage_path('oauth-private.key'), 0660);
        chmod(storage_path('oauth-public.key'), 0660);

        return self::SUCCESS;
    }
}
