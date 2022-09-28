<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                'attr'=> [
                    'placeholder' => 'Nom'
                ],
                'label' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom'
                    ])
                ]
            ])
            ->add('firstName', TextType::class, [
                'attr'=> [
                    'placeholder' => 'Prénom'
                ],
                'label' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'attr'=> [
                    'placeholder' => 'Votre@email.fr'
                ],
                'label' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre adresse email'
                    ]),
                    new Email([
                        'message' => 'Veuillez saisir une adresse email de type exemple@email.fr'
                    ])
                ]
            ])
            ->add('phone', TextType::class, [
                'attr'=> [
                    'placeholder' => 'N° de téléphone'
                ],
                'label' => false,
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '#^[0-9]{10}$#',
                        'htmlPattern' => '^[0-9]{10}$',
                        'message' => 'Votre numéro doit comporter 10 chiffres.'
                    ]),
                    new NotBlank([
                        'message' => 'veuillez saisir votre numéro de téléphone.'
                    ])
                ]
            ])
            ->add('object', TextType::class, [
                'attr'=> [
                    'placeholder' => 'Objet du message'
                ],
                'label' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir l\'objet de votre message'
                    ])
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr'=> [
                    'placeholder' => 'Saisissez votre message'
                ],
                'label' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre message'
                    ])
                ]
            ])
            ->add('rgpd', CheckboxType::class, [
                'label' => false,
                'required' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Merci d\'accepter la politique de confidentialité'
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez valider le consentement du traitement des données.',
                    ]),
                ],
            ])
            ->add('policy', CheckboxType::class, [
                'label' => false,
                'row_attr' => [
                  'class' => 'policy'
                ],
                'required' => false,
                'constraints' => [
                    new IsFalse([
                        'message' => 'Une erreur s\'est produite lors de l\'envoi du formulaire',
                    ]),
                ]
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn_primary btn_text cursor_pointer'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
