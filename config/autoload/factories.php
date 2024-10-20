<?php 
declare(strict_types=1);

use App\Model\Team;

return [
    'factories' => [
        \App\Model\Team::class => Database\Factories\TeamFactory::class,
    ],
];
