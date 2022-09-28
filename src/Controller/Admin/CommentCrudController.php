<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('content', 'Contenu'),
            AssociationField::new('user', 'Utilisateur'),
            DateTimeField::new('CreatedAt', 'Date de publication'),
            AssociationField::new('article', 'Article associé')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Liste des commentaires')
            ->setEntityLabelInPlural('un commentaire')
            ->setEntityLabelInSingular('des commentaires')
            ->setPageTitle('new', 'Ajouter un commentaire')
            ->setPageTitle('edit', 'Modification du commentaire')
            ->setDefaultSort(['createdAt' => 'DESC']);

    }
}
