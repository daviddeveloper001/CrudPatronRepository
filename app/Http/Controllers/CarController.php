<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Services\CarServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Requests\Car\CarUpdateRequest;

class CarController extends Controller
{
    public function __construct(private CarServices $carServices){}

    public function index(): JsonResponse
    {
        $cars = $this->carServices->getAllCars();

        return response()->json($cars);
    }

    public function show(Car $car): JsonResponse
    {
        $car = $this->carServices->getCarById($car);

        return response()->json($car);
    }

    public function store(CarStoreRequest $request): JsonResponse
    {
        $car = $this->carServices->createCar($request->validated());

        return response()->json($car, 201);
    }

    public function update(CarUpdateRequest $request, Car $car): JsonResponse
    {
        $card = $this->carServices->updateCar($car,$request->validated());
        return response()->json($card);
    }

    public function destroy(Car $car) : JsonResponse
    {
        $this->carServices->deleteCar($car);
        return response()->json(['message' => 'Car deleted'], 200);
    }
}
