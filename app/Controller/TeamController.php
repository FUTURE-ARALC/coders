<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\TeamDto;
use App\Request\StoreTeamRequest;
use App\Request\TeamAddUserRequest;
use App\Service\TeamService;
use App\Resource\Team as TeamResource;
use Hyperf\HttpServer\Request;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Metric\Adapter\NoOp\Counter;
use Hyperf\Metric\Adapter\Prometheus\MetricFactory;
use Hyperf\Metric\Contract\CounterInterface;
use Hyperf\Metric\CoroutineServerStats;
use Prometheus\CollectorRegistry;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;


class TeamController
{
    public function __construct(
        private TeamService $teamService,
        public CollectorRegistry $registry,
        public CoroutineServerStats $stats,
        public Counter $mCounter,
        public MetricFactory $metricFactory
        
    )
    {

    }


    public function index()
    {
    
      $counter = $this->metricFactory->makeCounter('list_team',['team']);
      $counter->with('index')->add(1);

        // // Register and observe a histogram metric
        // $histogram = $this->registry->getOrRegisterHistogram(
        //     'coders',                     // Namespace
        //     'some_event_duration',        // Metric name
        //     'Duration of some event',     // Help description
        //     ['ts']                      // Labels (optional)
        // );
        // $histogram->observe(1.5, ['teste']);  // Observe 1.5 seconds for this event


        // Registro de um contador
        
        // Render the metrics in Prometheus format

        return (new TeamResource($this->teamService->getTeams()))->toResponse();
    }

    public function store(StoreTeamRequest $request)
    {
        $counter = $this->registry->getOrRegisterCounter(
            'coders',                     // Namespace
            'some_store_counter',          // Metric name
            'Counts the occurrences of an store', // Help description
            ['type']                       // Labels (optional)
        );
        $counter->inc(['teste']);  // Increment the counter by 1

        // Register and observe a histogram metric
        $histogram = $this->registry->getOrRegisterHistogram(
            'coders',                     // Namespace
            'some_store_duration',        // Metric name
            'Duration of some event',     // Help description
            ['type']                      // Labels (optional)
        );
        $histogram->observe(1.5, ['teste']);  // Observe 1.5 seconds for this event
        $data = (new TeamDto($request->getName(),$request->getType()))->toArray();
        $team = $this->teamService->createTeam($data);
        return (new TeamResource($team))->toResponse();
    }

    public function show(string $uuid)
    {
        return (new TeamResource($this->teamService->getTeamById($uuid)))->toResponse();
    }

    public function update(string $uuid,StoreTeamRequest $request)
    {

    }

    public function addUser(string $uuid,TeamAddUserRequest $request)
    {
        $counter = $this->metricFactory->makeCounter('add_user_team',['team']);
        $counter->with('add_user_team')->add(1);

        return $this->teamService->addUser($uuid,$request->getUsers());
    }

    public function delete(string $uuid,ResponseInterface $response) : Psr7ResponseInterface
    {

        if($this->teamService->deleteTeamById($uuid)) {
            return $response->json(['data' => 'success']);

        }
        return (new TeamResource($this->teamService->deleteTeamById($uuid)))->toResponse();
    }
}
