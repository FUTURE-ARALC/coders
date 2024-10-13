<?php

declare(strict_types=1);

namespace App\Facade;

use Hyperf\Context\ApplicationContext;

class RedisFacade
{
    public static function __callStatic($method, $arguments)
    {
        $container = ApplicationContext::getContainer();
        $instance = $container->get(\App\Helper\RedisHelper::class);

        if (! $instance) {
            throw new \RuntimeException('RedisHelper instance is not found in container.');
        }

        return $instance->$method(...$arguments);
    }
}
