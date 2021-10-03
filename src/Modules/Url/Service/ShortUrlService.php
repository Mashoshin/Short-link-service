<?php

namespace src\Modules\Url\Service;

use Exception;
use src\Modules\Url\Contract\ShortUrlServiceInterface;
use src\Modules\Url\Contract\UrlRepositoryInterface;
use src\Modules\Url\Validator\UrlValidator;
use src\Modules\Url\ValueObject\ShortUrl;
use src\Modules\Url\ValueObject\Url;

class ShortUrlService implements ShortUrlServiceInterface
{
    private UrlRepositoryInterface $urlRepository;
    private UrlValidator $urlValidator;

    public function __construct(
        UrlRepositoryInterface $urlRepository,
        UrlValidator $urlValidator
    ) {
        $this->urlRepository = $urlRepository;
        $this->urlValidator = $urlValidator;
    }

    /**
     * @inheritDoc
     */
    public function create(string $url): string
    {
        $this->urlValidator->validate($url);
        if ($hash = $this->urlRepository->findHashByUrl($url)) {
            return (new ShortUrl($hash))->getShortUrl();
        }

        $hash = (new Url($url))->generateHash();
        if (!$this->urlRepository->save($hash, $url)) {
            throw new Exception('Saving error');
        }

        return (new ShortUrl($hash))->getShortUrl();
    }

    /**
     * @inheritDoc
     */
    public function get(string $hash): string
    {
        $url = $this->urlRepository->findUrlByHash($hash);
        if (!$url) {
            throw new Exception('Could not find original url.');
        }

        return $url;
    }
}