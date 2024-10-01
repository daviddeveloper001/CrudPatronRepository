<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Tickets\TicketStoreRequest;
use App\Http\Requests\Tickets\TicketUpdateRequest;

class TicketController extends Controller
{
    public function __construct(private TicketServices $ticketServices){}

    public function index () : JsonResponse
    {
        $tickets = $this->ticketServices->getAllTickets();

        return response()->json($tickets);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        $ticket = $this->ticketServices->getTicketById($ticket);
        return response()->json($ticket);
    }

    public function store(TicketStoreRequest $request): JsonResponse
    {
        $ticket = $this->ticketServices->createTicket($request->validated());
        return response()->json($ticket, 201);
    } 

    public function update(TicketUpdateRequest $request, Ticket $ticket): JsonResponse
    {
        $ticket = $this->ticketServices->updateTicket($ticket, $request->validated());
        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket) : JsonResponse 
    {
        $ticket = $this->ticketServices->deleteTicket($ticket);
        return response()->json(['message' => 'User deleted'], 200); 
    }

}
