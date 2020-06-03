<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('Username')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class) // On ajoute un champ pour confirmer le mot de passe 
            // On appel la classe PassewordType afin de masquer les mots de passes à la saisie du formulaire, permet d'affecter 
            // un type="password" aux champs du formulaire 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
