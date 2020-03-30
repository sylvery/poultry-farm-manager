<?php

namespace App\Controller;

use App\Repository\BatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MarketController extends AbstractController
{
    /**
     * @Route("/market", name="market_index")
     */
    public function index(BatchRepository $br)
    {
        return $this->render('market/index.html.twig', [
            'batches' => $br->findAllOnSale()
        ]);
    }
}
