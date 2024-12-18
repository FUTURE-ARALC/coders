<?php

declare(strict_types=1);
namespace App\Service;

use App\DTO\TeamDto;
use App\DTO\UserRelationsDto;
use App\Exception\Team\AbstractTeamException;
use App\Exception\Team\RegisterNotFoundException;
use App\Model\Model;
use App\Model\Team;
use App\Repository\TeamRepository;
use App\Request\AbstractTeamRequest;
use App\Request\StoreTeamRequest;
use Hyperf\Contract\PaginatorInterface;

use function Hyperf\Support\value;

class TeamService
{
    public function __construct(private TeamRepository $teamRepository) {}

    public function getTeams(): PaginatorInterface
    {
        return $this->teamRepository->get();
    }

    public function getTeamById(string $uuid): Team|AbstractTeamException
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
        $usersTeam = $this->teamRepository->getUserRelations($uuid);
        $arrayDiff = array_values(array_diff($uniqueUsersIds,$usersTeam->userRelations->pluck('id')->toArray()));
        $dataToCreate = new UserRelationsDto($usersTeam->id,$arrayDiff);
   
        return $this->teamRepository->addUser($usersTeam,$dataToCreate);
    }

    

    public function createTeam(array $data)
    {
        return $this->teamRepository->create($data);
    }
}
