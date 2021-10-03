<?php

namespace src\Modules\Url\Validator;

use Exception;

class UrlValidator
{
    /**
     * @param string $url
     * @throws Exception
     */
    public function validate(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid url.');
        }
    }
}