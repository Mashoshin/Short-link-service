<?php

namespace src\Modules\Url\Repository;

use src\Modules\Db\Query;
use src\Modules\Url\Contract\UrlRepositoryInterface;

class UrlRepository implements UrlRepositoryInterface
{
    public function findUrlByHash(string $hash): ?string
    {
        $source = (new Query())
            ->from($this->getTableName())
            ->where('hash', $hash)
            ->query();

        return $source?->url;
    }

    public function save(string $hash, string $url): bool
    {
        return (new Query())->insert($this->getTableName(), [
            'hash' => $hash,
            'url' => $url
        ]);
    }

    /**
     * @return string
     */
    private function getTableName(): string
    {
        return 'url';
    }
}