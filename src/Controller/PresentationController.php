<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PresentationController extends AbstractController
{
    #[Route('/presentation', name: 'app_presentation')]
    public function index(PresentationRepository $presentation): Response
    {
        $lesPresentation = $presentation->findAll();

        return $this->render('presentation/index.html.twig', [
            'controller_name' => 'PresentationController',
            'lesPresentation' => $lesPresentation,
        ]);
    }
}
