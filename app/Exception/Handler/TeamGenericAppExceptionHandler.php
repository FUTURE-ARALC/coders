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

namespace App\Exception\Handler;

use App\Exception\Team\AbstractTeamException;
use App\Exception\Team\RegisterNotFoundException;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Hyperf\Validation\ValidationExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;

//ValidationExceptionHandler
class TeamGenericAppExceptionHandler extends ExceptionHandler
{
    public function __construct(protected StdoutLoggerInterface $logger)
    {
    }

    public function handle(AbstractTeamException|Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error('Team Error');
        $this->logger->error(
            sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile())
        );
        $this->logger->error($throwable->getTraceAsString());

        $this->stopPropagation();
        return $response->withHeader('Server', 'Hyperf')
            ->withStatus($throwable->getCode())
            ->withBody(
                new SwooleStream(
                    json_encode(['message' => $throwable->getMessage(), 'code' => $throwable->getCode()])
                )
            );
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }


}
