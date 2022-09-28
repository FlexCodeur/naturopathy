<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;

    }


    public function configureFields(string $pageName): iterable
    {
        /* Initialisation service.yaml config to uploads images files in
        source directory*/
        $mediasDirectory = $this->getParameter('medias_directory');
        $uploadsDirectory = $this->getParameter('uploads_directory');

        yield TextField::new('name', 'Titre de l\'image');
        yield TextField::new('alt');
        $fileName = ImageField::new('fileName', 'Média')
            ->setFormType(FileUploadType::class)
            ->setBasePath($uploadsDirectory)
            ->setUploadDir($mediasDirectory)
            ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');

        /* Create a condition to get a not required fields */
        if(Crud::PAGE_EDIT == $pageName) {
           $fileName->setRequired(false);
        }

        yield $fileName;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Liste des médias')
            ->setEntityLabelInPlural('un média')
            ->setEntityLabelInSingular('des medias')
            ->setPageTitle('new', 'Ajouter un média')
            ->setPageTitle('edit', 'Modification du média');
    }

}
