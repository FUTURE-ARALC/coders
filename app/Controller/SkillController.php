<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\SkillDto;
use App\Request\StoreSkillRequest;
use App\Resource\Skill as SkillResource;
use App\Service\SkillService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class SkillController
{
    public function __construct(private SkillService $skillService)
    {
        
    }

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return (new SkillResource($this->skillService->getSkill()))->toResponse();
    }

    public function store(StoreSkillRequest $request) 
    {
        $data = (new SkillDto($request->getName(),$request->getType(),1));

        $skill = $this->skillService->createSkill($data->toArray());
        return (new SkillResource($skill))->toResponse();

    }

    public function show(string $uuid)
    {
        return (new SkillResource($this->skillService->getSkillById($uuid)))->toResponse();
    }
}

