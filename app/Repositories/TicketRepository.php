<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository extends BaseRepository
{
    const RELATIONS = [
        'car',
    ];
    public function __construct(Ticket $ticket)
    {
        parent::__construct($ticket, self::RELATIONS);
    }
}