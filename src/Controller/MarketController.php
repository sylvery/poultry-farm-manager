<?php

namespace App\Controller;

use App\Entity\Batch;
use App\Repository\BatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/market")
 */
class MarketController extends AbstractController
{
    /**
     * @Route("/", name="market_index")
     */
    public function index(BatchRepository $br)
    {
        return $this->render('market/index.html.twig', [
            'batches' => $br->findAllOnSale()
        ]);
    }

    /**
     * @Route("/batch/{id}", name="market_batch")
     */
    public function batch(Batch $batch): Response
    {
        return $this->render('market/batch.html.twig', [
            'batch' => $batch
        ]);
    }
}
