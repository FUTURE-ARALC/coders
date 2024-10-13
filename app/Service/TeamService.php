<?php

namespace App\Service;

use App\DTO\TeamDto;
use App\Exception\Team\RegisterNotFoundException;
use App\Repository\TeamRepository;
use App\Request\AbstractTeamRequest;
use App\Request\StoreTeamRequest;
use function Hyperf\Support\value;

class TeamService
{
    public function __construct(private TeamRepository $teamRepository)
    {

    }

    public function getTeams()
    {
        return $this->teamRepository->get();
    }

    public function getTeamById(string $uuid)
    {
        if($data = $this->teamRepository->getById($uuid)) {
            return $data;
        }

        throw new RegisterNotFoundException();
    }

    public function deleteTeamById(string $uuid)
    {
        if($data = $this->getTeamById($uuid)) {
            return $this->teamRepository->delete($data);
        }
    }

    public function addUser(string $uuid, array $usersIds)
    {
        $uniqueUsersIds = array_unique($usersIds);
        $usersTeam =  $this->teamRepository->getUserRelations($uuid);
        var_dump($usersTeam->userRelations->pluck('id')->toArray(), $uniqueUsersIds);
        $dataToCreate = array_diff($uniqueUsersIds,$usersTeam->userRelations->pluck('id')->toArray());
        var_dump($dataToCreate);
        $this->teamRepository->addUser($uuid,$uniqueUsersIds);
    }

    

    public function createTeam(array $data)
    {
        return $this->teamRepository->create($data);
    }
}
