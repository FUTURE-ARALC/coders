<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {

        return [
            'name' => $this->name, // Substitua por atributos reais do seu modelo

        ];
        
    }
}
