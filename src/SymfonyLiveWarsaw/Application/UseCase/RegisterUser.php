<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\UseCase;

use SymfonyLiveWarsaw\Application\Exception\UserAlreadyExists;
use SymfonyLiveWarsaw\Domain\Users;

class RegisterUser
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

    public function handle(RegisterUser\Command $command): void
    {
        if ($this->users->has($command->email())) {
            throw UserAlreadyExists::forEmail($command->email());
        }

        $user = $this->userFactory->create($command);
        $this->users->add($user);
    }
}
