<?php

namespace App\Controller;

use App\Repository\BatchRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(BatchRepository $batchrepo, CategoryRepository $catRepo)
    {
        return $this->render('default/index.html.twig', [
            'batches' => $batchrepo->findAll(),
            'categories' => $catRepo->findAll(),
        ]);
    }
}
