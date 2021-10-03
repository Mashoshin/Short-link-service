<?php

namespace src\Modules\Url\Contract;

use Exception;

interface ShortUrlServiceInterface
{
    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function create(string $url): string;

    /**
     * @param string $hash
     * @return string
     * @throws Exception
     */
    public function get(string $hash): string;
}