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

use Hyperf\HttpServer\Router\Router;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Nyholm\Psr7\Stream;
use Nyholm\Psr7\Response;

use function Swoole\Coroutine\Http\request;

// Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\c@index');

// Router::get('/favicon.ico', function () {
//     return '';
// });
Router::get('/health', function (ResponseInterface $response) {
    return $response->raw('HEALTHY')
        ->withStatus(200)
        ->withHeader('Content-Type', 'text/plain');
});

// Router::get('/metrics_new', function(CollectorRegistry $registry){
    
//     $renderer = new Prometheus\RenderTextFormat();
//     return $renderer->render($registry->getMetricFamilySamples());

    
// });




Router::get('/metrics', function(ResponseInterface $response){
    $registry = Hyperf\Context\ApplicationContext::getContainer()->get(Prometheus\CollectorRegistry::class);
  
    $renderer = new RenderTextFormat();
    $result = $renderer->render($registry->getMetricFamilySamples());
    
    return new Response(200, [
        'Content-Type' => RenderTextFormat::MIME_TYPE,
    ], $result);
                    
        

});



Router::addGroup('/team', function (){
    Router::get('/', 'App\Controller\TeamController@index');
    Router::post('/', 'App\Controller\TeamController@store');
    Router::get('/{uuid}', 'App\Controller\TeamController@show');
    Router::put('/{uuid}', 'App\Controller\TeamController@update');
    Router::delete('/{uuid}', 'App\Controller\TeamController@delete');
    Router::put('/{uuid}/user','App\Controller\TeamController@addUser');
});

Router::addGroup('/user', function (){
    Router::get('/', 'App\Controller\UserController@index');
    Router::post('/', 'App\Controller\UserController@store');
    Router::get('/{uuid}', 'App\Controller\UserController@show');
    // Router::put('/{uuid}', 'App\Controller\TeamController@update');
    // Router::delete('/{uuid}', 'App\Controller\TeamController@delete');
});

Router::addGroup('/skill', function (){
    Router::get('/', 'App\Controller\SkillController@index');
    Router::post('/', 'App\Controller\SkillController@store');
    Router::get('/{uuid}', 'App\Controller\SkillController@show');
    // Router::put('/{uuid}', 'App\Controller\TeamController@update');
    // Router::delete('/{uuid}', 'App\Controller\TeamController@delete');
});





