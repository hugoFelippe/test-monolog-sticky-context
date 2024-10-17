<?php

use Decahedron\StickyLogging\StickyContext;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$env = 'test';

StickyContext::defaultStack('application');
StickyContext::add('system.env', $env);

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(json_encode(StickyContext::all()));
    return $response;
});

$app->run();
