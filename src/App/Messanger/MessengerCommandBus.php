<?php

declare(strict_types=1);

namespace App\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;
use SymfonyLiveWarsaw\Application\Infrastructure\Command;
use SymfonyLiveWarsaw\Application\Infrastructure\CommandBus;
use SymfonyLiveWarsaw\Application\Infrastructure\CommandHandler;

final class MessengerCommandBus implements CommandBus
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function registerHandler(string $commandName, CommandHandler $handler): void
    {
    }

    public function handle(Command $command): void
    {
        $this->messageBus->dispatch($command);
    }
}
