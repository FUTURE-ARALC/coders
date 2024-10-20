<?php 
declare(strict_types=1);


use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

return [
    'providers' => [
        FakerGenerator::class => function () {
            return FakerFactory::create();
        },
    ],
];