<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\TicketService;
use Tests\TestCase;

class TicketServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('cron:generate-ticket');
    }

    /**
     * @return void
     */
    public function test_ReturnOpenTicketsCollection()
    {
        /** @var TicketService $service */
        $service = app(TicketService::class);

        $results = $service->getTicketsByStatus(request());
        $ticket  = $results->first();

        $this->assertFalse($ticket->status);
        $this->assertEquals('Illuminate\Database\Eloquent\Collection', $results::class);
    }

    /**
     * @return void
     */
    public function test_ReturnOpenTicketsPaginated()
    {
        /** @var TicketService $service */
        $service = app(TicketService::class);

        $results = $service->getTicketsByStatus(request(), false, true);
        $ticket  = $results->items()[0];

        $this->assertFalse($ticket->status);
        $this->assertEquals('Illuminate\Pagination\LengthAwarePaginator', $results::class);
    }

    /**
     * @return void
     */
    public function test_ReturnClosedTicketsCollection()
    {
        $this->artisan('cron:process-tickets');

        /** @var TicketService $service */
        $service = app(TicketService::class);

        $results = $service->getTicketsByStatus(request(), true);
        $ticket  = $results->first();

        $this->assertTrue($ticket->status);
        $this->assertEquals('Illuminate\Database\Eloquent\Collection', $results::class);
    }

    /**
     * @return void
     */
    public function test_ReturnClosedTicketsPaginated()
    {
        $this->artisan('cron:process-tickets');

        /** @var TicketService $service */
        $service = app(TicketService::class);

        $results = $service->getTicketsByStatus(request(), true, true);
        $ticket  = $results->items()[0];

        $this->assertTrue($ticket->status);
        $this->assertEquals('Illuminate\Pagination\LengthAwarePaginator', $results::class);
    }

    /**
     * @return void
     */
    public function test_ReturnTicketsByEmailPaginated()
    {
        $this->artisan('cron:process-tickets');

        /** @var TicketService $service */
        $service = app(TicketService::class);

        $user    = 1;
        $results = $service->getTicketsByEmail(request(), User::EMAIL_TEST, true);
        if (!count($results->items())) {
            $results = $service->getTicketsByEmail(request(), User::EMAIL_TEST_2, true);
            $user    = 2;
        }
        $ticket = $results->items()[0];

        if ($user === 1) {
            $this->assertEquals(User::EMAIL_TEST, $ticket->user_email);
        } else {
            $this->assertEquals(User::EMAIL_TEST_2, $ticket->user_email);
        }
        $this->assertEquals('Illuminate\Pagination\LengthAwarePaginator', $results::class);
    }

    /**
     * @return void
     */
    public function test_ReturnTicketsStats()
    {
        $this->artisan('cron:process-tickets');
        $this->artisan('cron:generate-ticket');

        /** @var TicketService $service */
        $service = app(TicketService::class);

        $results = $service->getTicketsStats();

        $this->assertIsArray($results);
        $this->assertArrayHasKey('total', $results);
        $this->assertArrayHasKey('unprocessed_total', $results);
        $this->assertArrayHasKey('user_most_tickets', $results);
        $this->assertArrayHasKey('last_processing_at', $results);
    }
}
