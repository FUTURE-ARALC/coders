<?php
declare(strict_types=1);

namespace App\Exception\Team;

use App\Enum\ExceptionMessage;
use Hyperf\Server\Exception\ServerException;
use Swoole\Http\Status;
use Throwable;

abstract class AbstractTeamException extends ServerException
{
    public function __construct(
        ExceptionMessage $message = ExceptionMessage::Generic,
        int $httpCode = Status::INTERNAL_SERVER_ERROR,
        ?Throwable $previous = null
    ) {
        parent::__construct($message->value, $httpCode, $previous);
    }
}


