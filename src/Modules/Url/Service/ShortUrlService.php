<?php

namespace src\Modules\Url\Service;

use Exception;
use src\Modules\Url\Contract\UrlRepositoryInterface;
use src\Modules\Url\ValueObject\ShortUrl;
use src\Modules\Url\ValueObject\Url;

class ShortUrlService
{
    private UrlRepositoryInterface $urlRepository;

    public function __construct(UrlRepositoryInterface $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function create(string $url): string
    {
        $hash = (new Url($url))->generateHash();
        if (!$this->urlRepository->save($hash, $url)) {
            throw new Exception('Saving error');
        }

        return (new ShortUrl($hash))->getShortUrl();
    }

    /**
     * @param string $hash
     * @return string|null
     * @throws Exception
     */
    public function get(string $hash): ?string
    {
        $url = $this->urlRepository->findUrlByHash($hash);
        if (!$url) {
            throw new Exception('Could not find original url.');
        }

        return $url;
    }
}