<?php

namespace App\Service;


use App\Exception\Team\RegisterNotFoundException;
use App\Repository\SkillRepository;

class SkillService
{
    public function __construct(private SkillRepository $skillRepository)
    {

    }

    public function getSkill()
    {
        return $this->skillRepository->get();
    }

    public function getSkillById(string $uuid)
    {
        if($data = $this->skillRepository->getById($uuid)) {
            return $data;
        }

        throw new RegisterNotFoundException();
    }

    public function deleteSkillById(string $uuid)
    {
        if($data = $this->getSkillById($uuid)) {
            return $this->skillRepository->delete($data);
        }
    }

    public function createSkill(array $data)
    {
        return $this->skillRepository->create($data);
    }
}
