<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use SymfonyLiveWarsaw\Application\Infrastructure\TransactionManager as TransactionManagerInterface;

final class TransactionManager implements TransactionManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function begin(): void
    {
        $this->manager->beginTransaction();
    }

    public function commit(): void
    {
        $this->manager->flush();
        $this->manager->commit();
    }

    public function rollback(): void
    {
        $this->manager->rollback();
    }
}
