<?php

namespace App\Controller\Admin;

use App\Entity\Appuser;
use App\Entity\Batch;
use App\Entity\Category;
use App\Entity\Expense;
use App\Entity\Farm;
use App\Entity\Income;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        // dump($routeBuilder->setController(BatchCrudController::class)->generateUrl()); exit;
        return $this->redirect($routeBuilder->setController(BatchCrudController::class)->generateUrl());
        // return parent::index();
    }
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Farm Back End');
    }

    public function configureCrud(): Crud
    {
        return Crud::new();
    }

    public function configureMenuItems(): iterable
    {
        $submenu1 = [
            MenuItem::linkToCrud('Expense', '', Expense::class),
            MenuItem::linkToCrud('Income', '', Income::class),
        ];

        $submenu2 = [
            MenuItem::linkToCrud('Batches', 'fas fa-users', Batch::class),
            MenuItem::linkToCrud('Category', 'fas fa-newspaper', Category::class)
        ];

        yield MenuItem::linkToUrl('Home', 'fas fa-door-open', '/');
        yield MenuItem::subMenu('Account', 'fas fa-rocket')->setSubItems($submenu1);
        yield MenuItem::subMenu('Batch', 'fas fa-folder-open')->setSubItems($submenu2);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', Appuser::class);
        yield MenuItem::linkToCrud('Farms', 'fas fa-briefcase', Farm::class);
        yield MenuItem::linkToUrl('Market', 'fas fa-door-open', '/market');
    }
}
