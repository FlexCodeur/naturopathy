<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('label', 'Nom de la catégorie'),
            SlugField::new('slug')->setTargetFieldName('label'),
            ChoiceField::new('parent', 'Type de catégorie')->setChoices([
                'Catégorie principale' => 1,
                'Sous-catégorie' => 2
            ]),
            AssociationField::new('media', 'Media (1920x700px recommandé ')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Liste des catégories')
            ->setEntityLabelInPlural('une catégorie')
            ->setEntityLabelInSingular('des catégories')
            ->setPageTitle('new', 'Ajouter une catégorie')
            ->setPageTitle('edit', 'Modification de la catégorie');
    }
}
