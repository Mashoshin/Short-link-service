<?php

namespace src\Modules\Url\ValueObject;

class ShortUrl
{
    public function __construct(private string $hash) {}

    /**
     * @return string
     */
    public function getShortUrl(): string
    {
        return getenv('INSTANCE_URI') . '/' . $this->hash;
    }
}