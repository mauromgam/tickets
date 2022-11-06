<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;

class TicketService
{
    /**
     * @param Request   $request
     * @param bool|null $status
     * @param bool      $paginated
     *
     * @return LengthAwarePaginator|Collection
     */
    public function getTicketsByStatus(
        Request $request,
        bool    $status = false,
        bool    $paginated = false
    ): LengthAwarePaginator|Collection {
        $tickets = $this->getTicketsBuilder()
            ->where('status', '=', $status);

        return $this->fetchData($request, $tickets, $paginated);
    }

    /**
     * @param Request $request
     * @param string  $email
     * @param bool    $paginated
     *
     * @return LengthAwarePaginator|Collection
     */
    public function getTicketsByEmail(
        Request $request,
        string  $email,
        bool    $paginated = false
    ): LengthAwarePaginator|Collection {
        $tickets = $this->getTicketsBuilder()
            ->where('email', '=', $email);

        return $this->fetchData($request, $tickets, $paginated);
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'total'              => "int",
        'unprocessed_total'  => "int",
        'user_most_tickets'  => "array",
        'last_processing_at' => "string",
    ])]
    public function getTicketsStats(): array
    {
        $total       = Ticket::all()->count();
        $unprocessed = $this->getTicketsByStatus(request())->count();
        $ticketChamp = $this->getTicketChampion();

        $lastProcessedTicket = $this->getLastUpdatedTicket();
        $lastTime            = $lastProcessedTicket?->updated_at->__toString();

        return [
            'total'              => $total,
            'unprocessed_total'  => $unprocessed,
            'user_most_tickets'  => $ticketChamp,
            'last_processing_at' => $lastTime,
        ];
    }

    /**
     * @return Builder
     */
    private function getTicketsBuilder(): Builder
    {
        return Ticket::join('users', 'users.id', '=', 'tickets.user_id')
            ->select([
                'tickets.id',
                'tickets.subject',
                'tickets.content',
                'tickets.status',
                'tickets.created_at',
                DB::raw('users.name as user_name'),
                DB::raw('users.email as user_email'),
            ]);
    }

    /**
     * @param Request $request
     * @param Builder $tickets
     * @param bool    $paginated
     *
     * @return LengthAwarePaginator|Collection
     */
    private function fetchData(Request $request, Builder $tickets, bool $paginated): LengthAwarePaginator|Collection
    {
        if ($paginated) {
            $page    = $request->input('page');
            $perPage = $request->input('per_page', 20);

            return $tickets->paginate($perPage, ['*'], 'page', $page);
        }

        return $tickets->get();
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'name'  => "string|null",
        'email' => "string|null",
    ])]
    private function getTicketChampion(): array
    {
        $champ = Ticket::join('users', 'users.id', '=', 'tickets.user_id')
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->limit(1)
            ->select([
                DB::raw('count(*) as total'),
                'users.name',
                'users.email',
            ])
            ->first();

        return [
            'name'  => $champ->name ?? null,
            'email' => $champ->email ?? null,
        ];
    }

    /**
     * @return Ticket|null
     */
    private function getLastUpdatedTicket(): ?Ticket
    {
        return Ticket::where('status', '=', true)
            ->orderBy('updated_at', 'desc')
            ->limit(1)
            ->first();
    }
}
