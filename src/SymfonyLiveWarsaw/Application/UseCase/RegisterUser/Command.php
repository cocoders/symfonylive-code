<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\UseCase\RegisterUser;

use SymfonyLiveWarsaw\Application\Infrastructure\Command as CommandInterface;
use SymfonyLiveWarsaw\Domain\Email;
use SymfonyLiveWarsaw\Domain\User;
use SymfonyLiveWarsaw\Domain\User\Fullname;
use SymfonyLiveWarsaw\Domain\User\PasswordHash;

final class Command implements CommandInterface
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $passwordHash;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;

    public function __construct(string $id, string $email, string $passwordHash)
    {
        $this->id = User\Id::fromString($id)->toString();
        $this->email = Email::fromString($email)->toString();
        $this->passwordHash = PasswordHash::fromString($passwordHash)->toString();
    }

    public function id(): User\Id
    {
        return User\Id::fromString($this->id);
    }

    public function email(): Email
    {
        return Email::fromString($this->email);
    }

    public function passwordHash(): PasswordHash
    {
        return PasswordHash::fromString($this->passwordHash);
    }

    public function fullName(): ?Fullname
    {
        if ($this->firstName && $this->lastName) {
            return Fullname::fromFirstAndLastName($this->firstName, $this->lastName);
        }
    }

    public function withFullName(string $firstName, string $lastName): Command
    {
        $command = clone $this;
        $command->firstName = $firstName;
        $command->lastName = $lastName;

        return $command;
    }
}
