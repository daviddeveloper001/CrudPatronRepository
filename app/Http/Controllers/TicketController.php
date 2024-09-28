<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(Request $request): Response
    {
        $tickets = Ticket::all();

        return view('ticket.index', compact('tickets'));
    }

    public function show(Request $request, Ticket $ticket): Response
    {
        return view('ticket.show', compact('ticket'));
    }

    public function store(TicketStoreRequest $request): Response
    {
        $ticket = Ticket::create($request->validated());

        return redirect()->route('ticket.index');
    }
}
