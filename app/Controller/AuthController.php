<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use App\Request\LoginRequest;
use App\Service\LoginService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

class AuthController
{
    public function __construct(private LoginService $loginService){}

    public function login(LoginRequest $request): HttpResponseInterface
    {

        $this->loginService->auth($request->getEmail(),$request->getPassword());
       
    }
}

