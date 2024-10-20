<?php

namespace App\Service;

use App\Exception\Team\RegisterNotFoundException;
use App\Model\User;
use App\Repository\UserRepository;


class UserService
{
    public function __construct(private UserRepository $userRepository) {}

    public function getUsers(): User
    {
        return $this->userRepository->get();
    }

    public function getUserByUuid(string $uuid)
    {
        if($data = $this->userRepository->getById($uuid)) {
            return $data;
        }
        throw new RegisterNotFoundException();
    }

    public function deleteTeamById(string $uuid)
    {
        if($data = $this->getUserByUuid($uuid)) {
            return $this->userRepository->delete($data);
        }
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }
}
