<?php

namespace App\Http\Response;

use craft\elements\Category;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class DoOtherAction
{
    public function __construct(
        private \BuzzingPixel\SlimBridge\ElementSetRoute\RouteParams $routeParams,
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function __invoke(): ResponseInterface
    {
        $element = $this->routeParams->getParam('element');

        assert($element instanceof Category);

        $response = $this->responseFactory->createResponse();

        $response->getBody()->write(
            'title: ' . $element->title,
        );

        return $response;
    }
}
