<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepository;
use App\Services\UserServices;

class UserController extends Controller
{
    public function __construct(private UserServices $userServices) {}
    public function index(): JsonResponse
    {
        $users = $this->userServices->getAllUsers();

        return response()->json($users);
    }

    public function show($id): JsonResponse
    {
        $user = $this->userServices->getUserById($id);

        return response()->json($user);
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->userServices->createUser($request->validated());
        return response()->json($user, 201);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user = $this->userServices->updateUser($user, $request->validated());
        return response()->json($user);
    }


    public function destroy(User $user) : JsonResponse
    {
        $this->userServices->deleteUser($user);
        return response()->json(['message' => 'User deleted'], 200);
    }

    public function getWithSameFirstAndLastName($name) : JsonResponse
    {

        $users = $this->userServices->getWithSameFirstAndLastName($name);

        return response()->json($users);
    }
}
