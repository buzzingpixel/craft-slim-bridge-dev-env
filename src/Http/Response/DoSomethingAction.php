<?php

namespace App\Http\Response;

use BuzzingPixel\SlimBridge\ElementSetRoute\RouteParsing\ParsedRoute;
use craft\elements\Entry;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteInterface;

class DoSomethingAction implements \BuzzingPixel\SlimBridge\ElementSetRoute\SetRouteFromParsed\RoutingCallbackContract
{
    public static function routingCallback(
        RouteInterface $route,
        ParsedRoute $parsedRoute,
    ): void {
    }
    public function __construct(
        private \BuzzingPixel\SlimBridge\ElementSetRoute\RouteParams $routeParams,
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function __invoke(): ResponseInterface
    {
        $element = $this->routeParams->getParam('element');

        assert($element instanceof Entry);

        $response = $this->responseFactory->createResponse();

        $response->getBody()->write(
            'title: ' . $element->title,
        );

        return $response;
    }
}
