<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Media;

class ArticleType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options): void
//    {
//        $builder
//            ->add('title')
//            ->add('slug')
//            ->add('description')
//            ->add('content')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('categories')
//            ->add('media', FileType::class, [
//                'data_class' => null,
//                'required' => false
//            ])
//        ;
//    }
//
//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => Article::class,
//        ]);
//    }
}
