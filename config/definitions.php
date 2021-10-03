<?php

use src\Modules\Url\Contract\ShortUrlServiceInterface;
use src\Modules\Url\Contract\UrlRepositoryInterface;
use src\Modules\Url\Repository\UrlRepository;
use src\Modules\Url\Service\ShortUrlService;
use function DI\autowire;

return [
    UrlRepositoryInterface::class => autowire(UrlRepository::class),
    ShortUrlServiceInterface::class => autowire(ShortUrlService::class)
];
