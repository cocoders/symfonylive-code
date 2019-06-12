<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Form\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use SymfonyLiveWarsaw\Application\Infrastructure\CommandBus;
use SymfonyLiveWarsaw\Application\UseCase\RegisterUser;
use SymfonyLiveWarsaw\Domain\User;

class UserController extends AbstractController
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

    /**
     * @Route("/user", name="user", methods={"POST"})
     */
    public function registerUser(Request $request)
    {
        $form = $this->createForm(RegisterUserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $this->commandBus->handle(new RegisterUser\Command(
                User\Id::generateNew()->toString(),
                $formData['email'],
                $this->encoderFactory->getEncoder(User::class)->encodePassword($formData['password'], '')
            ));

            $this->addFlash('success', 'User registered');
            return $this->redirectToRoute('user');
        }
        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
