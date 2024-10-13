<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\TeamDto;
use App\Request\StoreTeamRequest;
use App\Request\TeamAddUserRequest;
use App\Service\TeamService;
use App\Resource\Team as TeamResource;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Metric\Adapter\Prometheus\MetricFactory;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;


class TeamController
{
    public function __construct(
        private TeamService $teamService,
        public MetricFactory $metricFactory
    ) {}

    public function index()
    {
        $counter = $this->metricFactory->makeCounter('list_team',['team']);
        $counter->with('index')->add(1);
        return (new TeamResource($this->teamService->getTeams()))->toResponse();
    }

    public function store(StoreTeamRequest $request)
    {
        $data = (new TeamDto($request->getName(),$request->getType()))->toArray();
        $team = $this->teamService->createTeam($data);
        return (new TeamResource($team))->toResponse();
    }

    public function show(string $uuid)
    {
        return (new TeamResource($this->teamService->getTeamById($uuid)))->toResponse();
    }

    public function addUser(string $uuid,TeamAddUserRequest $request)
    {
        $counter = $this->metricFactory->makeCounter('add_user_team',['team']);
        $counter->with('add_user_team')->add(1);

        return $this->teamService->addUser($uuid,$request->getUsers());
    }

    public function delete(string $uuid,ResponseInterface $response) : Psr7ResponseInterface
    {
        return (new TeamResource($this->teamService->deleteTeamById($uuid)))->toResponse();
    }
}
