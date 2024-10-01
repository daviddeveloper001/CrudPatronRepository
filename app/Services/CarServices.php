<?php

namespace App\Services;

use App\Models\Car;
use App\Repositories\CarRepository;

class CarServices
{
    public function __construct(private CarRepository $carRepository)
    {

    }

    public function getAllCars()
    {
        return $this->carRepository->all();
    }

    public function getCarById($user)
    {
        return $this->carRepository->getById($user);
    }

    public function createCar(array $data)
    {
        return $this->carRepository->create($data);
    }

    public function updateCar(Car $car, array $data)
    {
        return $this->carRepository->update($car, $data);
    }

    public function deleteCar(Car $car)
    {
        return $this->carRepository->delete($car);
    }

}
