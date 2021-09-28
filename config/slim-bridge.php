<?php

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Psr7\Factory\ResponseFactory;

use function DI\autowire;

$containerBuilder = (new ContainerBuilder())
    ->useAnnotations(true)
    ->useAutowiring(true)
    ->ignorePhpDocErrors(true)
    ->addDefinitions([
        ResponseFactoryInterface::class => autowire(ResponseFactory::class),
    ]);

$container = $containerBuilder->build();

return [
    'containerInterface' => $container,
    'appCreatedCallback' => function (App $app): void {
        $app->get('/', function () use (
            $app
        ): ResponseInterface {
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
