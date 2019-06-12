<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use SymfonyLiveWarsaw\Application\Infrastructure\CommandBus;

class CommandBusCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(CommandBus::class)) {
            return;
        }
        $definition = $container->findDefinition(CommandBus::class);
        $taggedServices = $container->findTaggedServiceIds('command_handler');
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attribues) {
                $definition->addMethodCall(
                    'registerHandler',
                    [
                        $id . '\\Command',
                        new Reference($id)
                    ]
                );
            }
        }
    }
}
