<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\User;
use Tests\TestCase;

class TicketTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Ticket()
    {
        /** @var Ticket $ticket */
        $ticket = Ticket::factory(1)->create()->first();

        /** @var User $user */
        $user = $ticket->user;

        $this->assertIsString($ticket->subject);
        $this->assertIsString($ticket->content);
        $this->assertIsBool($ticket->status);

        $this->assertEquals('User', class_basename($user));
    }
}
