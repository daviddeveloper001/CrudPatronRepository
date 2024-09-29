<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    const RELATIONS = [
        'cars.tickets'
    ];

    public function __construct(User $user)
    {
        parent::__construct($user, self::RELATIONS);
    }



    public function getWithSameFirstAndLastName($name)
    {
        $first = $this->model
        ->where('first_name', $name);

        return $this->model
        ->where('last_name', $name)
        ->union($first)
        ->get();
    }
}