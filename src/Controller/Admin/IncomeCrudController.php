<?php

namespace App\Controller\Admin;

use App\Entity\Income;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IncomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Income::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Income')
            ->setEntityLabelInPlural('Income')
            ->setSearchFields(['id', 'description', 'amount']);
    }

    public function configureFields(string $pageName): iterable
    {
        $date = DateTimeField::new('date');
        $description = TextField::new('description');
        $amount = NumberField::new('amount');
        $category = AssociationField::new('category');
        $batch = AssociationField::new('batch');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $date, $description, $amount, $category, $batch];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $date, $description, $amount, $category, $batch];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$date, $description, $amount, $category, $batch];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$date, $description, $amount, $category, $batch];
        }
    }
}
