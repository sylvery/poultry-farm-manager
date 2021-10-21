<?php

namespace App\Controller\Admin;

use App\Entity\Batch;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BatchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Batch::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Batch')
            ->setEntityLabelInPlural('Batches')
            ->setPageTitle(Crud::PAGE_NEW, 'New Batch')
            ->setPageTitle(Crud::PAGE_EDIT, 'Update Batch Details')
            ->setSearchFields(['id', 'name', 'costPerBird', 'numberOfSpecimens', 'supplier', 'sellingprice']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $category = AssociationField::new('category');
        $dateAcquired = DateTimeField::new('dateAcquired');
        $costPerBird = NumberField::new('costPerBird', 'Unit Cost');
        $supplier = TextField::new('supplier');
        $farm = AssociationField::new('farm');
        $sellingprice = IntegerField::new('sellingprice');
        $id = IntegerField::new('id', 'ID');
        $numberOfSpecimens = IntegerField::new('numberOfSpecimens', 'Total Number of Specimen');
        $dateSoldOut = DateField::new('dateSoldOut');
        $onSale = Field::new('onSale');
        $expenses = AssociationField::new('expenses');
        $incomes = AssociationField::new('incomes');
        $totalDucks = Field::new('totalDucks');
        $totalAcquireCost = Field::new('totalAcquireCost', 'Total Cost');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $dateAcquired, $costPerBird, $totalDucks, $totalAcquireCost];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $dateAcquired, $costPerBird, $numberOfSpecimens, $supplier, $dateSoldOut, $onSale, $sellingprice, $expenses, $incomes, $category, $farm];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$farm, $name, $category, $dateAcquired, $costPerBird, $numberOfSpecimens, $supplier];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $category, $dateAcquired, $costPerBird, $supplier, $farm, $sellingprice, $onSale, $dateSoldOut];
        }
    }
}
