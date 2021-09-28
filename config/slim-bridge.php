<?php

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;

$containerBuilder = (new ContainerBuilder())
    ->useAnnotations(true)
    ->useAutowiring(true)
    ->ignorePhpDocErrors(true)
    ->addDefinitions([
        ResponseFactoryInterface::class => \DI\autowire(Slim\Psr7\Factory\ResponseFactory::class),
    ]);

$container = $containerBuilder->build();

return [
    'containerInterface' => $container,
    'appCreatedCallback' => function (App $app): void {
        $app->get('/', function () use ($app) {
            $responseFactory = $app->getContainer()->get(
                ResponseFactoryInterface::class
            );

            assert(
                $responseFactory instanceof ResponseFactoryInterface
            );

            $response = $responseFactory->createResponse();

            $response->getBody()->write('hello world');

            return $response;
        });

        $app->get('/test/thing', function () use ($app) {
            $responseFactory = $app->getContainer()->get(
                ResponseFactoryInterface::class
            );

            assert(
                $responseFactory instanceof ResponseFactoryInterface
            );

            $response = $responseFactory->createResponse();

            $response->getBody()->write('test-thing');

            return $response;
        });
    }
];
