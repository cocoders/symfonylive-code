<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\Infrastructure;

use Exception;

final class TransactionalCommandBus implements CommandBus
{
    /**
     * @var CommandBus
     */
    private $decoratedCommandBus;
    /**
     * @var TransactionManager
     */
    private $transactionManager;

    public function __construct(CommandBus $decoratedCommandBus, TransactionManager $transactionManager)
    {
        $this->decoratedCommandBus = $decoratedCommandBus;
        $this->transactionManager = $transactionManager;
    }

    public function registerHandler(string $commandName, CommandHandler $handler): void
    {
        $this->decoratedCommandBus->registerHandler($commandName, $handler);
    }

    public function handle(Command $command): void
    {
        $this->transactionManager->begin();
        try {
            $this->decoratedCommandBus->handle($command);
            $this->transactionManager->commit();
        } catch (Exception $exception) {
            $this->transactionManager->rollback();

            throw $exception;
        }
    }
}
