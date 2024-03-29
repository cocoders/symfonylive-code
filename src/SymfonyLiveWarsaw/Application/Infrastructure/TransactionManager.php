<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\Infrastructure;

interface TransactionManager
{
    public function begin(): void;
    public function commit(): void;
    public function rollback(): void;
}
