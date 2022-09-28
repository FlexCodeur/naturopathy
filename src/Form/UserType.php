<?php

namespace App\Form;

use App\Entity\Media;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options): void
//    {
//        $builder
//            ->add('firstName', TextType::class)
//            ->add('lastName', TextType::class)
//            ->add('username', TextType::class)
//            ->add('email', EmailType::class)
//            ->add('media', FileType::class, [
//                    'data_class'         => Media::class,
//                    'mapped'             => false,
//                    'allow_extra_fields' => [
//                    'name'               => 'name',
//                    'alt'                => 'alt'
//                ]
//            ])
//
//            ->add('submit', SubmitType::class)
//        ;
//    }
//
//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => User::class,
//            'class' => Media::class
//        ]);
//    }
}
