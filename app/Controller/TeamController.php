<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\TeamDto;
use App\Request\StoreTeamRequest;
use App\Request\TeamAddUserRequest;
use App\Service\TeamService;
use App\Resource\Team as TeamResource;
use Hyperf\Metric\Adapter\Prometheus\MetricFactory;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;



class TeamController
{
    public function __construct(
        private TeamService $teamService,
        public MetricFactory $metricFactory
    ) {}

    public function index(): HttpResponseInterface
    {
        $counter = $this->metricFactory->makeCounter('list_team',['team']);
        $counter->with('index')->add(1);
        return (new TeamResource($this->teamService->getTeams()))->toResponse();
    }

    public function store(StoreTeamRequest $request):HttpResponseInterface
    {
        $counter = $this->metricFactory->makeCounter('store_team',['team']);
        $counter->with('store')->add(1);
        $data = (new TeamDto($request->getName(),$request->getType()))->toArray();
        $team = $this->teamService->createTeam($data);
        return (new TeamResource($team))->toResponse()->withStatus(200);
    }

    public function show(string $uuid): HttpResponseInterface
    {
        return (new TeamResource($this->teamService->getTeamById($uuid)))->toResponse();
    }

    public function addUser(string $uuid,TeamAddUserRequest $request)
    {
        $counter = $this->metricFactory->makeCounter('add_user_team',['team']);
        $counter->with('add_user_team')->add(1);

        return $this->teamService->addUser($uuid,$request->getUsers());
    }

    public function delete(string $uuid,ResponseInterface $response) : HttpResponseInterface
    {
        return (new TeamResource($this->teamService->deleteTeamById($uuid)))->toResponse();
    }
}
