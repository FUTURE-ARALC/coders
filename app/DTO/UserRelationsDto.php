<?php
declare(strict_types=1);

namespace App\DTO;

use App\DTO\Interfaces\MassAddInterface;


class UserRelationsDto implements DTOInterface,MassAddInterface
{

    private array $userReltions;

    public function __construct(private int $entityId, private array $entityToCreate)
    {

    }

    public function toArray(): array
    {
        return $this->userReltions;
    }

    public function prepareData()
    {
       
        $this->userReltions = array_map(function($entity) {
            return [
                'team_id' => $this->entityId,
                'user_id' => $entity
            ];
        }, $this->entityToCreate);

        return $this;
    }




}
