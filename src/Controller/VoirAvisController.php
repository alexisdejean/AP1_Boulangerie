<?php

namespace App\Controller;

use App\Entity\Avis;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VoirAvisController extends AbstractController
{
    #[Route('/voir/avis', name: 'app_voir_avis')]
    public function index(EntityManagerInterface $em): Response
    {
        // Récupérer tous les avis triés par date décroissante
        $avisList = $em->getRepository(Avis::class)->findBy([], ['date_avis' => 'DESC']);

        return $this->render('voir_avis/index.html.twig', [
            'avisList' => $avisList,
        ]);
    }
}
