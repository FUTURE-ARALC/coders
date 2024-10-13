<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Events\Creating;
use Hyperf\DbConnection\Model\Model;
use Ramsey\Uuid\Uuid;

/**
 */
class User extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['name','action','tenant_id','uuid'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    public function creating(Creating $event)
    {
        $this->uuid = Uuid::uuid4()->toString();
    }
}
