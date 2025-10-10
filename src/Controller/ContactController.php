<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Entity\Utilisateur;

final class ContactController extends AbstractController
{
#[Route('/contact', name: 'app_contact')]
public function index(Request $request, EntityManagerInterface $em): Response
{
    if ($request->isMethod('POST')) {
        $numero = $request->request->get('numero', '');
        $commentaire = $request->request->get('commentaire', '');

        // Vérification du numéro
        if (!preg_match('/^(06|07)[0-9]{8}$/', $numero)) {
            $this->addFlash('error', 'Le numéro doit faire 10 chiffres et commencer par 06 ou 07.');
            return $this->redirectToRoute('app_contact');
        }

        // Vérification du commentaire
        if (empty(trim($commentaire))) {
            $this->addFlash('error', 'Le commentaire ne peut pas être vide.');
            return $this->redirectToRoute('app_contact');
        }

        // Récupérer l'utilisateur connecté
        $currentUser = $this->getUser();

        // Vérifier si le numéro appartient à un autre utilisateur
        $existingUser = $em->getRepository(Utilisateur::class)->findOneBy(['telephone' => $numero]);
        if ($existingUser && $existingUser->getId() !== $currentUser->getId()) {
            $this->addFlash('error', 'Ce numéro est déjà utilisé par un autre utilisateur.');
            return $this->redirectToRoute('app_contact');
        }


        // Si l'utilisateur n'a pas encore de numéro, on l'enregistre
        if (!$currentUser->getTelephone()) {
            $currentUser->setTelephone($numero);
            $em->persist($currentUser);
        }

        // Enregistrement du contact
        $contact = new Contact();
        $contact->setNumeroContact($numero);
        $contact->setDemandeContact($commentaire);
        $contact->setDateContact(new \DateTime());
        $contact->setUtilisateurContact($currentUser);
        $em->persist($contact);

        $em->flush();

        $this->addFlash('success', 'Votre message a été soumis avec succès.');
        return $this->redirectToRoute('app_contact');
    }

    return $this->render('contact/index.html.twig', [
        'controller_name' => 'ContactController',
    ]);
}


}
