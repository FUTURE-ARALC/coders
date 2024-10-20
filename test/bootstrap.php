<?php

declare(strict_types=1);

use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\ConfigInterface;

use function Hyperf\Coroutine\run;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
// ini_set('display_errors', 'on');
// ini_set('display_startup_errors', 'on');

// error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

// Swoole\Runtime::enableCoroutine(true);

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);




// ! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', Hyperf\Engine\DefaultOption::hookFlags());

Swoole\Runtime::enableCoroutine(true);
require BASE_PATH . '/vendor/autoload.php';

Hyperf\Di\ClassLoader::init();

$container = require BASE_PATH . '/config/container.php';

$config = $container->get(ConfigInterface::class);
$container->get(Hyperf\Contract\ApplicationInterface::class);

if ($config->get('app_env') === 'dev') {
    $config->set('databases.default.database', 'coders-testing');
}



run(function () use($container){
    $container = ApplicationContext::getContainer();
    $container->get('Hyperf\Database\Commands\Migrations\FreshCommand')->run(
        new Symfony\Component\Console\Input\StringInput(''),
        new Symfony\Component\Console\Output\ConsoleOutput()
    );
});

