<?php

namespace src\Modules\Url\Contract;

interface UrlRepositoryInterface
{
    /**
     * @param string $hash
     * @return string|null
     */
    public function findUrlByHash(string $hash): ?string;

    /**
     * @param string $url
     * @return string|null
     */
    public function findHashByUrl(string $url): ?string;

    /**
     * @param string $hash
     * @param string $url
     * @return bool
     */
    public function save(string $hash, string $url): bool;
}