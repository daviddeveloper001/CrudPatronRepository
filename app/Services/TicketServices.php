<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketServices
{
    public function __construct(private TicketRepository $ticketRepository){}

    public function getAllTickets()
    {
        return $this->ticketRepository->all();
    }

    public function getTicketById($ticket)
    {
        return $this->ticketRepository->getById($ticket);
    }

    public function createTicket(array $data)
    {
        $numberFormat = $data['amount'];
        $data['amount'] = number_format($numberFormat, 2, '.', '');
        return $this->ticketRepository->create($data);
    }

    public function updateTicket(Ticket $ticket, array $data)
    {
        $numberFormat = $data['amount'];
        $data['amount'] = number_format($numberFormat, 2, '.', '');
        return $this->ticketRepository->update($ticket, $data);
    }

    public function deleteTicket(Ticket $ticket) 
    {
        return $this->ticketRepository->delete($ticket);
    }

}
