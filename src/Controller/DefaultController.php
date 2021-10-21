<?php

namespace App\Controller;

use App\Controller\Admin\BatchCrudController;
use App\Controller\Admin\FarmCrudController;
use App\Repository\FarmRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(FarmRepository $farmRepo, AdminUrlGenerator $adminUrlGenerator)
    {
        $newfarmurl = $adminUrlGenerator->setController(FarmCrudController::class)->setAction(Action::NEW)->generateUrl();
        $newbatchurl = $adminUrlGenerator->setController(BatchCrudController::class)->setAction(Action::NEW)->generateUrl();
        if ($this->getUser()) {
            // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            return $this->render('default/index.html.twig', [
                'farms' => $farmRepo->findBy([
                    'owner' => $this->getUser(),
                ]),
                'newfarm' => $newfarmurl,
                'newbatch' => $newbatchurl,
            ]);
        } else {
            return $this->redirectToRoute('market_index');
        }
    }
}
