<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Events\Creating;
use Hyperf\DbConnection\Model\Model;
use Ramsey\Uuid\Uuid;

/**
 */
class Skill extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'skills';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['name','type','tenant_id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    public function creating(Creating $event)
    {
        $this->uuid = Uuid::uuid4()->toString();
    }
}
