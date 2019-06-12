<?php

namespace SymfonyLiveWarsaw\Application\Infrastructure;

interface CommandBus
{
    public function registerHandler(string $commandName, CommandHandler $handler): void;
    public function handle(Command $command): void;
}
