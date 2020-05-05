<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class FarmEAController extends EasyAdminController
{
    public function persistEntity($entity)
    {
        $entity->setOwner($this->getUser());
        parent::persistEntity($entity);
    }
}