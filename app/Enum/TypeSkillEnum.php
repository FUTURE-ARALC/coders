<?php 
declare(strict_types=1);

namespace App\Enum;

enum TypeSkillEnum : string
{
    case Hard = 'hardskill';
    case Soft = 'softskill';

    public static function getAllEnumCases(): array
    {
        return self::cases();
    }


}

