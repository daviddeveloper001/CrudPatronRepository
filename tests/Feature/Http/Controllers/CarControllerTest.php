<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CarController
 */
final class CarControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $cars = Car::factory()->count(3)->create();

        $response = $this->get(route('cars.index'));

        $response->assertOk();
        $response->assertViewIs('car.index');
        $response->assertViewHas('cars');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $car = Car::factory()->create();

        $response = $this->get(route('cars.show', $car));

        $response->assertOk();
        $response->assertViewIs('car.show');
        $response->assertViewHas('car.tickets');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CarController::class,
            'store',
            \App\Http\Requests\CarStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $patent = $this->faker->word();
        $user = User::factory()->create();

        $response = $this->post(route('cars.store'), [
            'patent' => $patent,
            'user_id' => $user->id,
        ]);

        $cars = Car::query()
            ->where('patent', $patent)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $cars);
        $car = $cars->first();

        $response->assertRedirect(route('cart.index'));
    }
}
