<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use SymfonyLiveWarsaw\Domain\Email;
use SymfonyLiveWarsaw\Domain\User;
use SymfonyLiveWarsaw\Domain\Users as UsersInterface;

final class Users implements UsersInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function has(Email $email): bool
    {
        return (bool) $this
            ->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email.value' => $email->toString()])
        ;
    }
}
