<?php

namespace App\Controller\Admin;

use App\Entity\Farm;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FarmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Farm::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Farm')
            ->setEntityLabelInPlural('Farm')
            ->setPageTitle(Crud::PAGE_INDEX, 'Your Farms')
            ->setPageTitle(Crud::PAGE_EDIT, 'Update Farm')
            ->setPageTitle(Crud::PAGE_NEW, 'New Farm')
            ->setSearchFields(['id', 'name', 'location']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $location = TextField::new('location');
        $owner = AssociationField::new('owner');
        $id = IntegerField::new('id', 'ID');
        $batches = AssociationField::new('batches');
        $batchCount = TextareaField::new('batch.count');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $location, $batchCount, $owner];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $location, $owner, $batches];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $location];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $location, $owner];
        }
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setOwner($this->getUser());
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->getOwner() == null) {
            $entityInstance->setOwner($this->getUser());
        }
        $entityManager->persist($entityInstance);
        $entityManager->flush();
        // dump($entityInstance); exit;
    }
}
