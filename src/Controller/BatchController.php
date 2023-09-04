<?php

namespace App\Controller;

use App\Controller\Admin\BatchCrudController;
use App\Controller\Admin\ExpenseCrudController;
use App\Entity\Batch;
use App\Form\BatchType;
use App\Repository\BatchRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/batch")
 */
class BatchController extends AbstractController
{
    /**
     * @Route("/", name="batch_index", methods={"GET"})
     */
    public function index(BatchRepository $batchRepository): Response
    {
        return $this->render('batch/index.html.twig', [
            'batches' => $batchRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="batch_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $batch = new Batch();
        $form = $this->createForm(BatchType::class, $batch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($batch);
            $entityManager->flush();

            return $this->redirectToRoute('batch_index');
        }

        return $this->render('batch/new.html.twig', [
            'batch' => $batch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="batch_show", methods={"GET"})
     */
    public function show(Batch $batch, AdminUrlGenerator $adminUrlGenerator): Response
    {
        $editbatchurl = $adminUrlGenerator->setController(BatchCrudController::class)->setAction(Action::EDIT)->generateUrl();
        $newexpenseurl = $adminUrlGenerator->setController(ExpenseCrudController::class)->setAction(Action::NEW)->generateUrl();
        return $this->render('batch/show.html.twig', [
            'batch' => $batch,
            'editbatchurl' => $editbatchurl,
            'newexpenseurl' => $newexpenseurl,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="batch_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Batch $batch): Response
    {
        $form = $this->createForm(BatchType::class, $batch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batch_index', [
                'id' => $batch->getId(),
            ]);
        }

        return $this->render('batch/edit.html.twig', [
            'batch' => $batch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="batch_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Batch $batch): Response
    {
        if ($this->isCsrfTokenValid('delete'.$batch->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($batch);
            $entityManager->flush();
        }

        return $this->redirectToRoute('batch_index');
    }
}
