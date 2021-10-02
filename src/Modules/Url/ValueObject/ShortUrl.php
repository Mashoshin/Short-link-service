<?php

namespace src\Modules\Url\ValueObject;

class ShortUrl
{
    private string $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getShortUrl(): string
    {
        return getenv('INSTANCE_URI') . '/' . $this->hash;
    }
}