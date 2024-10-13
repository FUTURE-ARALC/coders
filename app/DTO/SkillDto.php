<?php
declare(strict_types=1);

namespace App\DTO;

use App\Enum\TypeSkillEnum;
use App\Exception\Skill\InvalidTypeException;

class SkillDto implements DTOInterface
{
    public function __construct(private string $name, private string $type,private int $tenant_id = 1)
    {
        $this->validate();
    }

    private function validate()
    {
      if(!$this->validateType()){
         throw new InvalidTypeException;
      }
    }

    private function validateType()
    {
        return in_array($this->type, array_column(TypeSkillEnum::cases(), 'value'), true);
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
