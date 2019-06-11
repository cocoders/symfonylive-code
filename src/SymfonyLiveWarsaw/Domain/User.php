<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Domain;

use SymfonyLiveWarsaw\Domain\User\Fullname;
use SymfonyLiveWarsaw\Domain\User\PasswordHash;

class User
{
    /**
     * @var User\Id
     */
    private $id;
    /**
     * @var Email
     */
    private $email;
    /**
     * @var PasswordHash
     */
    private $passwordHash;
    /**
     * @var Fullname
     */
    private $fullname;

    public function __construct(User\Id $id, Email $email, PasswordHash $passwordHash)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function id(): User\Id
    {
        return $this->id;
    }

    public function fullname(): ?Fullname
    {
        return $this->fullname;
    }

    public function changeFullname(Fullname $fullname): void
    {
        $this->fullname = $fullname;
    }
}
