<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\UseCase\RegisterUser;

use SymfonyLiveWarsaw\Domain\User;

class UserFactory
{
    public function create(Command $command): User
    {
        $user = new User(
            $command->id(),
            $command->email(),
            $command->passwordHash()
        );

        if ($command->fullName()) {
            $user->changeFullname($command->fullName());
        }

        return $user;
    }
}
