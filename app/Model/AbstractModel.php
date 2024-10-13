<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Context\Context;
use Hyperf\Database\Model\Events\Creating;
use Hyperf\DbConnection\Model\Model;
use Ramsey\Uuid\Uuid;

abstract class AbstractModel extends Model
{
    
    protected function boot(): void
    {
        parent::boot(); // Ensure parent boot is called
        static::addGlobalScope('tenant', function ($builder) {
            $tenantId = Context::get('tenant_id');
            
            if ($tenantId) {
                $builder->where('tenant_id', $tenantId);
            }
        });
    }
    

    public function creating(Creating $event)
    {
        $this->uuid = Uuid::uuid4()->toString();
    }
}
