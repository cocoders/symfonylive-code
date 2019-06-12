<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Domain\User;

use InvalidArgumentException;

final class PasswordHash
{
    /**
     * @var string
     */
    private $value;

    public static function fromString(string $hash): PasswordHash
    {
        $info = password_get_info($hash);

        if (!$info || !isset($info['algoName'])) {
            throw new InvalidArgumentException('Not known hashing algorithm used');
        }

        if ($info['algoName'] === 'unknown') {
            throw new InvalidArgumentException('Not known hashing algorithm used');
        }

        $passwordHash = new PasswordHash();
        $passwordHash->value = $hash;

        return $passwordHash;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
