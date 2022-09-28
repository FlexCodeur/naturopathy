<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Method User getUser()
 */

class UserCrudController extends AbstractCrudController
{
    public function __construct(
        private EntityRepository $entityRepo,
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $userId = $this->getUser()->getId();
        $query = $this->entityRepo->createQueryBuilder(
            $searchDto,
            $entityDto,
            $fields,
            $filters
        );

        $query->andWhere('entity.id != :userId')->setParameter('userId', $userId);

        return $query;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName', 'Prénom')->onlyOnForms(),
            TextField::new('lastName', 'Nom')->onlyOnForms(),
            TextField::new('fullName', 'Utilisateur')->hideOnForm(),
            TextField::new('username', 'Pseudo'),
            EmailField::new('email', 'Email'),
            TextField::new('password', 'Mot de passe')
                ->setFormType(PasswordType::class)
                ->onlyOnForms()
                ->onlyWhenCreating(),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->renderAsBadges([
                    'ROLE_ADMIN' => 'success',
                    'ROLE_EDITOR' => 'warning'
                ])
                ->setRequired(false)
                ->setChoices([
                'Administrateur' => 'ROLE_ADMIN',
                'Editeur' => 'ROLE_EDITOR'
            ]),
            ];
    }

    // To hash manually password in admin dashboard
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /**  @var User $user */
        $user = $entityInstance;

        $plainPassword = $user->getPassword();
        $hashPassword = $this->passwordHasher->hashPassword($user,
            $plainPassword);

        $user->setPassword($hashPassword);

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Liste des utilisateurs')
            ->setEntityLabelInPlural('un utilisateur')
            ->setEntityLabelInSingular('des utilisateurs')
            ->setPageTitle('new', 'Ajouter un utilisateur')
            ->setPageTitle('edit', 'Modification de l\'utilisateur');
    }

}
