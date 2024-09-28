<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TicketController
 */
final class TicketControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $tickets = Ticket::factory()->count(3)->create();

        $response = $this->get(route('tickets.index'));

        $response->assertOk();
        $response->assertViewIs('ticket.index');
        $response->assertViewHas('tickets');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get(route('tickets.show', $ticket));

        $response->assertOk();
        $response->assertViewIs('ticket.show');
        $response->assertViewHas('ticket');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketController::class,
            'store',
            \App\Http\Requests\TicketStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $date = Carbon::parse($this->faker->dateTime());
        $amount = $this->faker->numberBetween(-10000, 10000);
        $card_id = $this->faker->randomNumber();

        $response = $this->post(route('tickets.store'), [
            'date' => $date,
            'amount' => $amount,
            'card_id' => $card_id,
        ]);

        $tickets = Ticket::query()
            ->where('date', $date)
            ->where('amount', $amount)
            ->where('card_id', $card_id)
            ->get();
        $this->assertCount(1, $tickets);
        $ticket = $tickets->first();

        $response->assertRedirect(route('ticket.index'));
    }
}
