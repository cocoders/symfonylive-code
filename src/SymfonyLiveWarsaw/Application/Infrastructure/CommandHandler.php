<?php

namespace SymfonyLiveWarsaw\Application\Infrastructure;

interface CommandHandler
{
    public function handle(Command $command): void;
}
