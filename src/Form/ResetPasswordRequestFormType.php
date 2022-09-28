<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ResetPasswordRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'autocomplete' => 'email',
                    'class' => 'form__content--input',
                    'placeholder' => 'Saisissez votre adresse email'
                ],
                'required' => 'false',
                'label' => false,
                'row_attr' => ['class' => 'form__content--input'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre adresse email',
                    ]),
                    new Email ([
                        'message' => 'Veuillez saisir un email de type \'votre@email.com\''
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
