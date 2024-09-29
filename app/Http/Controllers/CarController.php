<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(Request $request): Response
    {
        $cars = Car::all();

        return view('car.index', compact('cars'));
    }

    public function show(Request $request, Car $car): Response
    {
        return view('car.show', compact('car.tickets'));
    }

    public function store(CarStoreRequest $request): Response
    {
        $car = Car::create($request->validated());

        return redirect()->route('cart.index');
    }
}
