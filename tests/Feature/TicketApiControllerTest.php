<?php

namespace Tests\Feature;

use App\Services\TicketService;
use Tests\TestCase;

class TicketApiControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_ReturnOpenTicketsEndpoint()
    {
        $response = $this->get('/api/tickets/open');
        $content  = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertEquals('Open tickets retrieved successfully', $content['message']);
    }

    /**
     * @return void
     */
    public function test_ReturnClosedTicketsEndpoint()
    {
        $response = $this->get('/api/tickets/closed');
        $content  = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertEquals('Closed tickets retrieved successfully', $content['message']);
    }

    /**
     * @return void
     */
    public function test_ReturnUserTicketsEndpoint()
    {
        $this->artisan('cron:generate-ticket');

        /** @var TicketService $service */
        $service = app(TicketService::class);
        $ticket  = $service->getTicketsByStatus(request())->first();

        $response = $this->get('/api/users/' . $ticket->user_email . '/tickets');
        $content  = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertEquals('Tickets by email retrieved successfully', $content['message']);
        $this->assertEquals($ticket->user_email, $content['data']['data'][0]['user_email']);
    }

    /**
     * @return void
     */
    public function test_ReturnTicketsStatsEndpoint()
    {
        $response = $this->get('/api/stats');
        $content  = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertEquals('Tickets Stats retrieved successfully', $content['message']);

        $results = $content['data'];
        $this->assertArrayHasKey('total', $results);
        $this->assertArrayHasKey('unprocessed_total', $results);
        $this->assertArrayHasKey('user_most_tickets', $results);
        $this->assertArrayHasKey('last_processing_at', $results);
    }
}
