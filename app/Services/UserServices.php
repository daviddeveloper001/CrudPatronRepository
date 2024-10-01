<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Response;
use App\Exceptions\UserException;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use App\Exceptions\UserNotFoundException;

class UserServices
{
    public function __construct(private UserRepository $userRepository) {}


    // Servicio: UserServices
    public function getAllUsers(int $perPage = 15)
    {
        return $this->userRepository->all($perPage);
    }


    public function getUserById($user)
    {
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
            throw new UserException('El dominio de correo no está permitido');
        }

        return $this->userRepository->create($data);

        // Registrar en un log
        Log::info("Usuario creado: {$user->id}");
    }

    public function updateUser(User $user, array $data)
    {

        $data = $this->prepareUserData($data);

        $restrictedDomains = ['example.com', 'test.com'];
        $emailDomain = substr(strrchr($data['email'], "@"), 1);

        if (in_array($emailDomain, $restrictedDomains)) {
            throw new UserException('El dominio de correo no está permitido');
        }

        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user)
    {
        if($this->verifyThatUserHasCars($user))
        {
            throw new UserException('El usuario tiene coches asociados');
        }
        return $this->userRepository->delete($user);
    }

    public function getWithSameFirstAndLastName($name)
    {
        return $this->userRepository->getWithSameFirstAndLastName($name);
    }

    public function verifyThatUserHasCars($user)
    {
        if ($user->cars->count() > 0) {
            return true;
        }

        return false;
    }
    
    private function prepareUserData(array $data): array
    {
        // Normalizar el nombre y apellido
        $data['first_name'] = ucfirst(strtolower($data['first_name']));
        $data['last_name'] = ucfirst(strtolower($data['last_name']));

        // Si el password está presente, lo encriptamos
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}
