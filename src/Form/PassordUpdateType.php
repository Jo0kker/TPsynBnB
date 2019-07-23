<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class PassordUpdateType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, $this->getConfiguration('Ancien mot de passe','Ancien mot de passe'))
            ->add('newPassword', PasswordType::class, $this->getConfiguration('Nouveau mot de passe', 'Mot de passe'))
            ->add('confirmPassword', PasswordType::class, $this->getConfiguration('Confirmation nouveau mot de passe', 'nouveau mot de passe'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
