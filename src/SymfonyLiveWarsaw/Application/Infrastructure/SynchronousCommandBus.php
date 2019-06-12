<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Application\Infrastructure;

use SymfonyLiveWarsaw\Application\Exception\HandlerNotFound;

final class SynchronousCommandBus implements CommandBus
{
    /**
     * @var CommandHandler[]
     */
    private $handlers = [];
    public function registerHandler(string $commandName, CommandHandler $handler): void
    {
        $this->handlers[$commandName] = $handler;
    }

    public function handle(Command $command): void
    {
        if (!isset($this->handlers[get_class($command)])) {
            throw new HandlerNotFound(get_class($command));
        }

        $handler = $this->handlers[get_class($command)];
        $handler->handle($command);
    }
}
