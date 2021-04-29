<?php

namespace App\Controller;

use App\Entity\Avaliation;
use App\Entity\Music;
use App\Service\MusicAvaliationService;
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

    #[Route('/{id}', name: 'avaliation_show', methods: ['GET'])]
    public function show(Avaliation $avaliation): Response
    {
        return $this->render('avaliation/show.html.twig', [
            'avaliation' => $avaliation,
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
