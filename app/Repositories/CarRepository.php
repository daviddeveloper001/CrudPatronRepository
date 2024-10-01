<?php
namespace App\Repositories;

use App\Models\Car;

class CarRepository extends BaseRepository
{
    const RELATIONS = [
        'tickets',
        'user',
    ];


    public function __construct(Car $car)
    {
        parent::__construct($car, self::RELATIONS);
    }
}