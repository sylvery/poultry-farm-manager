<?php

namespace App\Controller;

use App\Repository\FarmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(FarmRepository $farmRepo)
    {
        if ($this->getUser()) {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            return $this->render('default/index.html.twig', [
                'farms' => $farmRepo->findBy([
                    'owner' => $this->getUser(),
                ]),
            ]);
        } else {
            return $this->render('market/index.html.twig');
        }
    }
}
