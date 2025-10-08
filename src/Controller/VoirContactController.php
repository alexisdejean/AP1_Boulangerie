<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

final class VoirContactController extends AbstractController
{
    #[Route('/voir/contact', name: 'app_voir_contact')]
    public function index(EntityManagerInterface $em): Response
    {
        $contacts = $em->getRepository(Contact::class)->findBy([], ['date_contact' => 'DESC']);
        return $this->render('voir_contact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}