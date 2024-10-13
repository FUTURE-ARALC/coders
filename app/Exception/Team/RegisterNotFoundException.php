<?php

namespace App\Exception\Team;

use App\Enum\ExceptionMessage;
use Swoole\Http\Status;
use Throwable;

class RegisterNotFoundException extends AbstractTeamException
{
    public function __construct()
    {
        $message = ExceptionMessage::NotFound;
        $code = Status::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
