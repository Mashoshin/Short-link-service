<?php

namespace src;

use DI\ContainerBuilder;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use src\Domain\helpers\ResponseHelper;
use src\Modules\Url\UrlController;
use Throwable;

class App
{
    private \Slim\App $app;

    public function __construct()
    {
        $this->init();
    }

    public function run()
    {
        $this->app->run();
    }

    private function init(): void
    {
        $this->createApp();
        $this->app->addRoutingMiddleware();
        $this->app->addBodyParsingMiddleware();
        $this->configureRouter();
        $this->addErrorHandler();
    }

    private function createApp(): void
    {
        $definitions = require 'config/definitions.php';

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(
            $definitions
        );

        $container = $containerBuilder->build();
        AppFactory::setContainer($container);
        $this->app = AppFactory::create();
    }

    private function configureRouter(): void
    {
        $this->app->get('/{hash}', [UrlController::class, 'get']);
        $this->app->post('/', [UrlController::class, 'create']);
    }

    private function addErrorHandler(): void
    {
        $app = $this->app;
        $errorHandler = function (
            ServerRequestInterface $request,
            Throwable $exception,
        ) use ($app) {
            $data = ResponseHelper::getServerError($exception);

            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write($data);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500);
        };

        $errorMiddleware = $this->app->addErrorMiddleware(true, true, true);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);
    }
}
