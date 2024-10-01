<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Database\Eloquent\Casts\Json;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private UserServices $userServices) {}


    // Controlador: UserController
    public function index()
    {
        // Puedes ajustar el valor predeterminado de paginación si lo necesitas
        $users = $this->userServices->getAllUsers(2); // 10 usuarios por página, por ejemplo

        return UserResource::collection($users);
    }


    public function show(User $user)
    {
        $user = $this->userServices->getUserById($user->id);

        return new UserResource($user);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $this->userServices->createUser($request->validated());
        return new JsonResponse($user, Response::HTTP_CREATED);
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $user = $this->userServices->updateUser($user, $request->validated());

        return new JsonResponse($user, Response::HTTP_OK);
    }


    public function destroy(User $user): JsonResponse
    {
        $this->userServices->deleteUser($user);
        return new JsonResponse(['message' => 'User deleted'], Response::HTTP_OK);
    }

    public function getWithSameFirstAndLastName($name): JsonResponse
    {

        $users = $this->userServices->getWithSameFirstAndLastName($name);

        return new JsonResponse($users);
    }
}
