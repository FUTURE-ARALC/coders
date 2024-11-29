<?php

declare(strict_types=1);

namespace App\Model;

class User extends AbstractModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['name','action','tenant_id','uuid','email','password'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    // public function creating(Creating $event)
    // {
    //     $this->uuid = Uuid::uuid4()->toString();
    // }
}
