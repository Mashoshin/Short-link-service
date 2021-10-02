<?php

namespace src\Modules\Url;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\Domain\helpers\ResponseHelper;
use src\Modules\Url\Service\ShortUrlService;
use Throwable;

class UrlController
{
    private ShortUrlService $shortUrlService;

    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }

    public function get(Request $request, Response $response, $args)
    {
        $url = $this->shortUrlService->get($args['hash']);
        return $response
            ->withAddedHeader('Location', $url)
            ->withStatus(302);
    }

    public function create(Request $request, Response $response, $args)
    {
        $postParams = $request->getParsedBody();
        if (!isset($postParams['url'])) {
            throw new Exception("Body should contain 'url' param.");
        }

        $shortUrl = $this->shortUrlService->create($postParams['url']);
        $data = ResponseHelper::getOk(['short_url' => $shortUrl]);
        $response->getBody()->write($data);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}