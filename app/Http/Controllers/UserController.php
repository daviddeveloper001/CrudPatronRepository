<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {

    }
    public function index() : JsonResponse
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }

    public function show(User $user) : JsonResponse
    {

        $user = $this->userRepository->getById($user->id);
        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(UserStoreRequest $request) : JsonResponse
    {
        $user = new User($request->all());
        $user = $this->userRepository->save($user);
        return response()->json($user);
    }

    public function update(Request $request, User $user) : JsonResponse
    {
        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->fill($request->all());
        $user = $this->userRepository->save($user);

        return response()->json($user);
    }

    public function destroy(User $user) : JsonResponse
    {
        $this->userRepository->delete($user);
        return response()->json(['message' => 'User deleted'], 200);
    }

    public function getWithSameFirstAndLastName($name) : JsonResponse
    {

        //$name = request()->get('name');


        $users = $this->userRepository->getWithSameFirstAndLastName($name);

        return response()->json($users);
    }
}