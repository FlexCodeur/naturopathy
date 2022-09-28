<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Votre nouveau mot de passe'
                    ],
                    'label' => false,
                    'row_attr' => ['class' => 'form__content--input'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir votre mot de passe',
                        ]),
                        new Length([
                            'min' => 8,
                            'minMessage' => 'Votre mot de passe doit contenir {{ limit }} caractères minimum',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                        new Regex([
                            'pattern' => '#^(?=(.*[A-Z])+)(?=(.*[a-z])+)(?=(.*[\d])+)(?=.*\W)(?!.*\s).{8,100}$#',
                            'htmlPattern' => '^(?=(.*[A-Z])+)(?=(.*[a-z])+)(?=(.*[\d])+)(?=.*\W)(?!.*\s).{8,100}$',
                            'message' => 'Votre mot de passe doit contenir 8 caractères minimum dont une majuscule, un chiffre et un caractère spécial'
                        ])
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder'  => 'Confirmez votre mot de passe'
                    ],
                    'label' => false,
                    'row_attr' => ['class' => 'form__content--input'],
                ],
                'invalid_message' => 'Les mots de passe saisis ne correspondent pas. Veuillez réessayer.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
