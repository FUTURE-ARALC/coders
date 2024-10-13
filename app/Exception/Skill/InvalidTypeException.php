<?php

namespace App\Exception\Skill;

use App\Enum\ExceptionMessage;
use App\Exception\Skill\AbstractSkillException;
use Swoole\Http\Status;
use Throwable;

class InvalidTypeException extends AbstractSkillException
{
    public function __construct()
    {
        $message = ExceptionMessage::InvalidTypeSkill;
        $code = Status::BAD_REQUEST;
        parent::__construct($message, $code);
    }
}
