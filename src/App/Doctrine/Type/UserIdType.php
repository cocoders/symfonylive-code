<?php

declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use SymfonyLiveWarsaw\Domain\User;

final class UserIdType extends GuidType
{
    public function getName(): string
    {
        return 'user_id';
    }

    /**
     * @param null|string $value
     * @param AbstractPlatform $platform
     * @return User\Id|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?User\Id
    {
        return $value ? User\Id::fromString($value) : null;
    }
}
