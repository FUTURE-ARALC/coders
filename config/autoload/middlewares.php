<?php

declare(strict_types=1);

use App\Middleware\TenantMiddleware;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'http' => [
        App\Middleware\CorsMiddleware::class,
        TenantMiddleware::class,
        \Hyperf\Validation\Middleware\ValidationMiddleware::class,
        \Hyperf\Metric\Middleware\MetricMiddleware::class,
    ],
];
