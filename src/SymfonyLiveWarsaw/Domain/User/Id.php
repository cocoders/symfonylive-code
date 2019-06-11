<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Domain\User;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class Id
{
    /**
     * @var string
     */
    private $value;

    public static function fromString(string $value): Id
    {
        if (!Uuid::isValid($value)) {
            throw new InvalidArgumentException('%s is not valid uuid', $value);
        }

        $id = new Id();
        $id->value = $value;

        return $id;
    }

    public static function generateNew(): Id
    {
        return self::fromString(Uuid::uuid4()->__toString());
    }

    public function toString(): string
    {
        return $this->value;
    }
}
