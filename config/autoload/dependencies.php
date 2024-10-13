<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    \App\Helper\RedisHelper::class => function (\Psr\Container\ContainerInterface $container) {
        return new \App\Helper\RedisHelper($container->get(\Hyperf\Redis\RedisFactory::class));
    },
    Prometheus\Storage\Adapter::class => Hyperf\Metric\Adapter\Prometheus\RedisStorageFactory::class,

];
