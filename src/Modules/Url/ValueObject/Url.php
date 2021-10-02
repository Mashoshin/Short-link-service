<?php

namespace src\Modules\Url\ValueObject;

class Url
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function generateHash(): string
    {
        return md5(uniqid($this->url, true));
    }
}
