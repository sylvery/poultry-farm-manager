<?php

namespace App\Controller\Admin;

use App\Entity\Appuser;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AppuserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Appuser::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
            ->setPageTitle(Crud::PAGE_EDIT, 'Update User')
            ->setPageTitle(Crud::PAGE_NEW, 'Add User')
            ->setSearchFields(['id', 'email', 'roles']);
    }

    public function configureFields(string $pageName): iterable
    {
        $email = TextField::new('email');
        $password = TextField::new('password');
        $roles = ArrayField::new('roles');
        $id = IntegerField::new('id', 'ID');
        $farms = AssociationField::new('farms');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$email, $roles];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $email, $roles, $password, $farms];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$email, $password, $roles];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$email, $password, $roles];
        }
    }
}
