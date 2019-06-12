<?php

declare(strict_types = 1);

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['constraints' => [new NotBlank(), new Email()]])
            ->add('password', PasswordType::class, ['constraints' => [new NotBlank()]])
            ->add('firstName')
            ->add('lastName')
        ;
    }
}
