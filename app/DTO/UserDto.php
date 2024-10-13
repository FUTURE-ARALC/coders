<?php
declare(strict_types=1);

namespace App\DTO;
class UserDto implements DTOInterface
{
    public function __construct(private string $name, private int $active,private int $tenant_id = 1)
    {

    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'active' => $this->active,
            'tenant_id' => $this->tenant_id,
            ];

    }

}
