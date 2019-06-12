<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\UseCase;

use SymfonyLiveWarsaw\Application\Exception\UserAlreadyExists;
use SymfonyLiveWarsaw\Application\Infrastructure\Command;
use SymfonyLiveWarsaw\Application\Infrastructure\CommandHandler;
use SymfonyLiveWarsaw\Domain\Users;

class RegisterUser implements CommandHandler
{
    /**
     * @var Users
     */
    private $users;
    /**
     * @var RegisterUser\UserFactory
     */
    private $userFactory;

    public function __construct(Users $users, RegisterUser\UserFactory $userFactory)
    {
        $this->users = $users;
        $this->userFactory = $userFactory;
    }

    /**
     * @param RegisterUser\Command $command
     */
    public function handle(Command $command): void
    {
        if ($this->users->has($command->email())) {
            throw UserAlreadyExists::forEmail($command->email());
        }

        $user = $this->userFactory->create($command);
        $this->users->add($user);
    }
}
