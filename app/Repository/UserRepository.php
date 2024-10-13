<?php
declare(strict_types=1);

namespace App\Repository;
use App\Model\User;

class UserRepository
{
    public function __construct(private User  $repository)
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

    public function delete(User $data): bool
    {
        if($data) {
            return $data->delete();
        }
        return false;
    }
}
