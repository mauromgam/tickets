<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('oauth_clients')->count()) {
            Artisan::call('passport:install');
        }

        User::factory()->create([
            'name'  => 'Test User',
            'email' => User::EMAIL_TEST,
        ]);

        User::factory()->create([
            'name'  => 'Test User 2',
            'email' => USER::EMAIL_TEST_2,
        ]);

        Ticket::factory(99)->create();
        Ticket::where('status', '=', false)
            ->orderBy('created_at')
            ->limit(95)
            ->update([
                'status' => true,
            ]);
    }
}
