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


namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\Database\Model\Events\Creating;
use Ramsey\Uuid\Uuid;

abstract class Model extends BaseModel
{
    
}
