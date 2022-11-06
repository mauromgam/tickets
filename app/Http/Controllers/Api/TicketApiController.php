<?php

namespace App\Http\Controllers\Api;

use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketApiController extends ApiBaseController
{
    /**
     * Return a paginated list of open tickets
     *
     * @param TicketService $service
     * @param Request       $request
     *
     * @return JsonResponse
     */
    public function getOpenTickets(TicketService $service, Request $request): JsonResponse
    {
        $data = $service->getTicketsByStatus($request, false, true);

        return $this->sendResponse($data, 'Open tickets retrieved successfully');
    }

    /**
     * Return a paginated list of closed tickets
     *
     * @param TicketService $service
     * @param Request       $request
     *
     * @return JsonResponse
     */
    public function getClosedTickets(TicketService $service, Request $request): JsonResponse
    {
        $data = $service->getTicketsByStatus($request, true, true);

        return $this->sendResponse($data, 'Closed tickets retrieved successfully');
    }

    /**
     * Return a paginated list of tickets by email
     *
     * @param TicketService $service
     * @param Request       $request
     * @param string        $email
     *
     * @return JsonResponse
     */
    public function getTicketsByEmail(TicketService $service, Request $request, string $email): JsonResponse
    {
        $data = $service->getTicketsByEmail($request, $email, true);

        return $this->sendResponse($data, 'Tickets by email retrieved successfully');
    }

    /**
     * Return the latest tickets stats
     *
     * @param TicketService $service
     *
     * @return JsonResponse
     */
    public function getStats(TicketService $service): JsonResponse
    {
        $data = $service->getTicketsStats();

        return $this->sendResponse($data, 'Tickets Stats retrieved successfully');
    }
}
