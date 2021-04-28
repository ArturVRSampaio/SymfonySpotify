<?php

namespace App\Controller;

use App\Entity\Avaliation;
use App\Form\AvaliationType;
use App\Repository\AvaliationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avaliation')]
class AvaliationController extends AbstractController
{
    #[Route('/', name: 'avaliation_index', methods: ['GET'])]
    public function index(AvaliationRepository $avaliationRepository): Response
    {
        return $this->render('avaliation/index.html.twig', [
            'avaliations' => $avaliationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'avaliation_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $avaliation = new Avaliation();
        $form = $this->createForm(AvaliationType::class, $avaliation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avaliation);
            $entityManager->flush();

            return $this->redirectToRoute('avaliation_index');
        }

        return $this->render('avaliation/new.html.twig', [
            'avaliation' => $avaliation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'avaliation_show', methods: ['GET'])]
    public function show(Avaliation $avaliation): Response
    {
        return $this->render('avaliation/show.html.twig', [
            'avaliation' => $avaliation,
        ]);
    }

    #[Route('/{id}/edit', name: 'avaliation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avaliation $avaliation): Response
    {
        $form = $this->createForm(AvaliationType::class, $avaliation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avaliation_index');
        }

        return $this->render('avaliation/edit.html.twig', [
            'avaliation' => $avaliation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'avaliation_delete', methods: ['POST'])]
    public function delete(Request $request, Avaliation $avaliation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avaliation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avaliation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('avaliation_index');
    }
}
