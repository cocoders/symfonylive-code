<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use SymfonyLiveWarsaw\Application\Infrastructure\CommandBus;
use SymfonyLiveWarsaw\Application\UseCase\RegisterUser;
use SymfonyLiveWarsaw\Domain\User;

class AppFixtures extends Fixture
{
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(CommandBus $commandBus, EncoderFactoryInterface $encoderFactory)
    {
        $this->commandBus = $commandBus;
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        foreach (['leszek.prabucki@gmail.com', 'contact@cocoders.com'] as $email) {
            $this->commandBus->handle(new RegisterUser\Command(
                User\Id::generateNew()->toString(),
                $email,
                $this->encoderFactory->getEncoder(User::class)->encodePassword('abc123%asd', '')
            ));
        }
    }
}
