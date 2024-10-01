<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;

class UserServices
{
    public function __construct(private UserRepository $userRepository) {}


    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUserById($user)
    {
        $this->getUserExists($user);

        return $this->userRepository->getById($user);
    }
    public function createUser(array $data)
    {
        $data['first_name'] = ucfirst(strtolower($data['first_name']));
        $data['last_name'] = ucfirst(strtolower($data['last_name']));
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);


        $restrictedDomains = ['example.com', 'test.com'];
        $emailDomain = substr(strrchr($data['email'], "@"), 1);

        if (in_array($emailDomain, $restrictedDomains)) {
            throw new \Exception('El dominio de correo no está permitido');
        }
        
        return $this->userRepository->create($data);

        // Registrar en un log
        Log::info("Usuario creado: {$user->id}");
    }

    public function updateUser(User $user, array $data)
    {
        $this->getUserExists($user);
        $data['first_name'] = ucfirst(strtolower($data['first_name']));
        $data['last_name'] = ucfirst(strtolower($data['last_name']));

        $restrictedDomains = ['example.com', 'test.com'];
        $emailDomain = substr(strrchr($data['email'], "@"), 1);

        if (in_array($emailDomain, $restrictedDomains)) {
            throw new \Exception('El dominio de correo no está permitido');
        }

        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user)
    {
        //$this->getUserExists($user);

        $this->verifyThatUserHasCars($user);

        //return $this->userRepository->delete($user);
    }

    public function getWithSameFirstAndLastName($name)
    {
        return $this->userRepository->getWithSameFirstAndLastName($name);
    }


    public function getUserExists($user)
    {
        if(!$this->userRepository->getById($user))
        {
            return false;
        }

        return true;
    }

    public function verifyThatUserHasCars($user)
    {
        if($user->cars->count() > 0)
        {    
            return response()->json(['message' => 'El usuario tiene coches asociados '], 200);
        }
    }

}
