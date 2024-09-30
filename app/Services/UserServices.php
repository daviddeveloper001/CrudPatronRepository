<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserServices
{
    public function __construct(private UserRepository $userRepository) {}


    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUserById($user)
    {

        if($this->userRepository->getById($user) == null) {

            return response()->json(['message' => 'User not found'], 404);
        }
        return $this->userRepository->getById($user);

    }
    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser(User $user, array $data)
    {
        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user)
    {
        return $this->userRepository->delete($user);
    }

    public function getWithSameFirstAndLastName($name)
    {

        return $this->userRepository->getWithSameFirstAndLastName($name);
    }
    


}
