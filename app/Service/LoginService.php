<?php

namespace App\Service;

use App\Exception\Team\RegisterNotFoundException;
use App\Repository\UserRepository;
use Hyperf\Contract\PaginatorInterface;



class LoginService
{
    public function __construct(private UserRepository $userRepository) {}

    public function auth(string $email,string $password)
    {

        if($this->checkPassword($email,$password)) {
            var_dump('true');
            return true;
        }
        var_dump('false');
        return 'error';

        

    }

    private function checkPassword(string $email,string $password): bool
    {
        if($user = $this->userRepository->getByEmail($email)) {
            return password_verify($password, $user->password);
        }
        return false;
    }

    private function makeJwt()
    {

    }

    
}
