<?php
declare(strict_types=1);

namespace App\Enum;

enum ExceptionMessage : string
{
    case NotFound = 'not_found';
    case Generic = 'generic';
    case InvalidTypeSkill = 'Invalid Type Skill' ;
}
