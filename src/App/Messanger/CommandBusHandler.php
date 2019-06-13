<?php

declare(strict_types=1);

namespace App\Messenger;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use SymfonyLiveWarsaw\Application\Infrastructure\Command;
use SymfonyLiveWarsaw\Application\Infrastructure\SynchronousCommandBus;

final class CommandBusHandler implements MessageHandlerInterface
{
    /**
     * @var SynchronousCommandBus
     */
    private $commandBus;

    public function __construct(SynchronousCommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Command $command)
    {
        $this->commandBus->handle($command);
    }
}
