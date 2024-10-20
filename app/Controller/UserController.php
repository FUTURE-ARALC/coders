<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\UserDto;
use App\Request\StoreUserRequest;
use App\Resource\User as UserResource;
use App\Service\UserService;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;


class UserController
{
    public function __construct(private UserService $userService) {}

    public function index(): HttpResponseInterface
    {
        return (new UserResource($this->userService->getUsers()))->toResponse();
    }

    public function store(StoreUserRequest $request) : HttpResponseInterface
    {
        $data = (new UserDto($request->getName(),1,1));
        $user = $this->userService->createUser($data->toArray());
        return (new UserResource($user))->toResponse();

    }

    public function show(string $uuid) : HttpResponseInterface
    {
        return (new UserResource($this->userService->getUserByUuid($uuid)))->toResponse();
    }
}
