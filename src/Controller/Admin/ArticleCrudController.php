<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('title', 'Titre'),
            yield SlugField::new('slug')
                ->hideOnIndex()
                ->setTargetFieldName('title'),
            yield AssociationField::new('media'),
            yield TextareaField::new('description', 'Description courte (160 caractères max)')
                ->hideOnIndex()
                ->setMaxLength(160),
            yield TextEditorField::new("content", 'Contenu de l\'article')
                ->hideOnIndex(),
            yield AssociationField::new('categories', 'Catégorie'),
            Yield AssociationField::new('user', 'Auteur')
                ->hideOnForm(),
            yield DateTimeField::new('createdAt', 'Créée le')
                ->hideOnForm(),
            yield DateTimeField::new('updatedAt', 'Modifiée le')
                ->hideOnForm()
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Liste des articles')
            ->setEntityLabelInPlural('un article')
            ->setEntityLabelInSingular('des articles')
            ->setPageTitle('new', 'Ajouter un article')
            ->setPageTitle('edit', 'Modification de l\'article')
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPaginatorPageSize(20)
            ->setSearchFields(['title', 'description', 'user'])
            ->setTimezone('Europe/Paris')
            ;
    }


}
