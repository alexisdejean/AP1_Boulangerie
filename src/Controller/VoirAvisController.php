<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoirAvisController extends AbstractController
{
    #[Route('/voir/avis', name: 'app_voir_avis')]
    public function index(): Response
    {
        return $this->render('voir_avis/index.html.twig', [
            'controller_name' => 'VoirAvisController',
        ]);
    }
}
