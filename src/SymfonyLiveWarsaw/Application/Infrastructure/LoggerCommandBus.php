<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\Infrastructure;

use Exception;
use Psr\Log\LoggerInterface;

final class LoggerCommandBus implements CommandBus
{
    /**
     * @var CommandBus
     */
    private $decoratedCommandBus;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(CommandBus $decoratedCommandBus, LoggerInterface $logger)
    {
        $this->decoratedCommandBus = $decoratedCommandBus;
        $this->logger = $logger;
    }

    public function registerHandler(string $commandName, CommandHandler $handler): void
    {
        $this->decoratedCommandBus->registerHandler($commandName, $handler);
    }

    public function handle(Command $command): void
    {
        $this->logger->info(sprintf('Command appear %s', get_class($command)));

        try {
            $this->decoratedCommandBus->handle($command);
            $this->logger->info(sprintf('Command handled %s', get_class($command)));
        } catch (Exception $exception) {
            $this->logger->error(
                sprintf('Error from command %s', get_class($command)),
                [
                    'exception' => $exception
                ]
            );

            throw $exception;
        }
    }
}
