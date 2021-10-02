<?php

use src\Modules\Url\Contract\UrlRepositoryInterface;
use src\Modules\Url\Repository\UrlRepository;
use function DI\autowire;

return [
    UrlRepositoryInterface::class => autowire(UrlRepository::class)
];
