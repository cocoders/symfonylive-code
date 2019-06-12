<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Domain;

interface Users
{
    public function add(User $user): void;
    public function has(Email $email): bool;
}
