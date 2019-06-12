<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\Exception;

use DomainException;
use SymfonyLiveWarsaw\Domain\Email;

final class UserAlreadyExists extends DomainException
{
    public static function forEmail(Email $email): UserAlreadyExists
    {
        return new UserAlreadyExists(sprintf('User already exists for %s email', $email->toString()));
    }
}
