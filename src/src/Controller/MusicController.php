<?php

namespace App\Controller;

use App\Entity\Music;
use App\Service\MusicAvaliationService;
use App\Form\MusicType;
use App\Repository\AvaliationRepository;
use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/music')]
class MusicController extends AbstractController
{
    #[Route('/', name: 'music_index', methods: ['GET'])]
    public function index(MusicRepository $musicRepository): Response
    {
        return $this->render('music/index.html.twig', [
            'music' => $musicRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'music_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $music = new Music();
        $form = $this->createForm(MusicType::class, $music);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($music);
            $entityManager->flush();

            return $this->redirectToRoute('music_index');
        }

        return $this->render('music/new.html.twig', [
            'music' => $music,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'music_show', methods: ['GET'])]
    public function show(Music $music): Response
    {
        return $this->render('music/show.html.twig', [
            'music' => $music,
        ]);
    }

    #[Route('/{id}/edit', name: 'music_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Music $music): Response
    {
        $form = $this->createForm(MusicType::class, $music);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('music_index');
        }

        return $this->render('music/edit.html.twig', [
            'music' => $music,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'music_delete', methods: ['POST'])]
    public function delete(Request $request, Music $music): Response
    {
        if ($this->isCsrfTokenValid('delete'.$music->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($music);
            $entityManager->flush();
        }

        return $this->redirectToRoute('music_index');
    }

    #[Route('/music_avaliate/{id}', name: 'music_avaliate', methods: ['POST'])]
    public function avaliate(Request $request, Music $music, MusicAvaliationService $avaliation): Response
    {
        if ($this->isCsrfTokenValid('avaliate'.$music->getId(), $request->request->get('_token'))) {
            $user = $this->getUser();
            $avaliation->avalia($user, $music);
        }
        return $this->redirectToRoute('avaliation_index');
    }
}
