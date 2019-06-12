<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\Exception;

use DomainException;

final class HandlerNotFound extends DomainException
{
    public function __construct(string $commandClassName)
    {
        parent::__construct(sprintf('Handler for "%s" not found!', $commandClassName));
    }
}
