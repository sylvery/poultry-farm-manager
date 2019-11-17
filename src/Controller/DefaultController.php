<?php

namespace App\Controller;

use App\Repository\BatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(BatchRepository $batchrepo)
    {
        return $this->render('default/index.html.twig', [
            'batches' => $batchrepo->findAll(),
        ]);
    }
}
