<?php

namespace App\Controller;

use App\Entity\Band;
use App\Form\BandType;
use App\Repository\BandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/band')]
class BandController extends AbstractController
{
    #[Route('/', name: 'band_index', methods: ['GET'])]
    public function index(BandRepository $bandRepository): Response
    {
        return $this->render('band/index.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'band_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $band = new Band();
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('band_index');
        }

        return $this->render('band/new.html.twig', [
            'band' => $band,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'band_show', methods: ['GET'])]
    public function show(Band $band): Response
    {
        return $this->render('band/show.html.twig', [
            'band' => $band,
        ]);
    }

    #[Route('/{id}/edit', name: 'band_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Band $band): Response
    {
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('band_index');
        }

        return $this->render('band/edit.html.twig', [
            'band' => $band,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'band_delete', methods: ['POST'])]
    public function delete(Request $request, Band $band): Response
    {
        if ($this->isCsrfTokenValid('delete'.$band->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($band);
            $entityManager->flush();
        }

        return $this->redirectToRoute('band_index');
    }
}
