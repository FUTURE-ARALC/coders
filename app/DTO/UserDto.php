<?php
declare(strict_types=1);

namespace App\DTO;
class UserDto implements DTOInterface
{
    public function __construct(private string $name, private int $active,private int $tenant_id = 1,private string $password,private string $email)
    {

    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'active' => $this->active,
            'tenant_id' => $this->tenant_id,
            'email' => $this->email,
            'password' => $this->password,
            ];

    }

    public static function fromRequest($request): self
    {
        $password = password_hash($request->getPassword(), PASSWORD_DEFAULT);
        return new self(
            $request->getName(),
            1, // tenant ID
            1, // Status
            $password,
            $request->getEmail(),
        );
    }


}
