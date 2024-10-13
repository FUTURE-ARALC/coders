<?php

declare(strict_types=1);

namespace App\Model;

use App\Facade\RedisFacade;
use Hyperf\Database\Model\Events\Created;
use Hyperf\Database\Model\Events\Creating;
use Hyperf\DbConnection\Model\Model;
use RedisHelper;
use Ramsey\Uuid\Uuid;

/**
 */
class Team extends AbstractModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'teams';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'tenant_id',
        'uuid',
        'name',
        'type',
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    public function created(Created $event)
    {
        $model = $event->getModel();
        RedisFacade::save('team-'.$model->uuid,json_encode($model));
    }

    public function userRelations()
    {
        return $this->belongsToMany(User::class,'user_relations','team_id','user_id');
    }




}
