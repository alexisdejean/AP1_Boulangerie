<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Avis;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(Request $request, EntityManagerInterface $em, AvisRepository $avisRepo): Response
    {
        if($request->isMethod('POST')){
            $note = $request->request->get('note');
            $commentaire = $request->request->get('commentaire');

            $avis = new Avis();
            $avis->setNoteAvis((int) $note);
            $avis->setCommentaireAvis($request->request->get('commentaire', ''));

            $avis->setDateAvis(new \DateTime());
            $avis->setIdUtilisateurAvis($this->getUser());


            $em->persist($avis);
            $em->flush();

            $this->addFlash('success', 'Votre avis a été soumis avec succès.');
            return $this->redirectToRoute('app_avis');
        }
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
        ]);
    }
}
