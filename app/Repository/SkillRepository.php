<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Skill;

class SkillRepository
{
    public function __construct(private Skill $repository)
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

    public function update(int $id, array $data)
    {

    }

    public function delete(Skill $data): bool
    {
        if($data) {
            return $data->delete();
        }
        return false;
    }
}
