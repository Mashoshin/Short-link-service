<?php

namespace src\Modules\Url\ValueObject;

class Url
{
    public function __construct(private string $url) {}

    /**
     * @return string
     */
    public function generateHash(): string
    {
        return substr(md5(uniqid($this->url, true)), 0, 10);
    }
}
