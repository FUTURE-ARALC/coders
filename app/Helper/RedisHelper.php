<?php
declare(strict_types=1);

namespace App\Helper;

use Hyperf\Redis\RedisFactory;

class RedisHelper 
{
    protected $redis;

    public function __construct(RedisFactory $redisFactory)
    {
        $this->redis = $redisFactory->get('default');
    }

    public function save(string $key,$value, $ttl = 3600) 
    {
        $this->redis->set($key,$value,$ttl);
    }
}
