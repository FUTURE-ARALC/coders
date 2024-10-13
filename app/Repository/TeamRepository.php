<?php
declare(strict_types=1);

namespace App\Repository;
use App\Model\Team;

class TeamRepository
{
    public function __construct(private Team  $repository)
    {

    }

    public function get()
    {
        return $this->repository->paginate();
    }

    public function getById(string $uuid)
    {
        return $this->repository->where('uuid',$uuid)->first();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function addUser(string $uuid,array $uniqueUsersIds) 
    {
        if($team = $this->getById($uuid)) {
            
        }
    }

    public function getUserRelations(string $uuid, string $type = 'team')
    {
        return $this->repository->where('uuid',$uuid)->with('userRelations')->first();
    }

    public function update(int $id, array $data)
    {

    }

    public function delete(Team $data): bool
    {
        if($data) {
            return $data->delete();
        }
        return false;
    }
}
