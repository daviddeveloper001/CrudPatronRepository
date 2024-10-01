<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->created_at,
            'cars' => $this->cars->map(function($car) {
                return [
                    'patent' => $car->patent,
                    'created_at' => $car->created_at,
                    'tickets' => $car->tickets->map(function($ticket) {
                        return [
                            'date' => $ticket->date,
                            'amount' => $ticket->amount
                        ];
                    })
                ];
            }),

        ];
    }
}
