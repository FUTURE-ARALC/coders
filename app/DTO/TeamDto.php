<?php
declare(strict_types=1);

namespace App\DTO;

use App\Enum\TypeSkillEnum;
use App\Exception\Team\InvalidTypeException;
use Ramsey\Uuid\Uuid;

class TeamDto implements DTOInterface
{
    public function __construct(private string $name, private string $type,private int $tenant_id = 1)
    {
    }



    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'type' => $this->type,
            'tenant_id' => $this->tenant_id,
            ];

    }

}
