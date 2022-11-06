<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, string>
     */
    public function definition(): array
    {
        /** @var User $user */
        $user = User::inRandomOrder()
            ->first();

        return [
            'user_id' => $user->id,
            'subject' => $this->faker->text(100),
            'content' => $this->faker->text,
            'status'  => false,
        ];
    }
}
