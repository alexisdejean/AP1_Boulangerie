<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use App\Entity\Presentation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PresentationController extends AbstractController
{
    #[Route('/presentation', name: 'app_presentation')]
    public function index(PresentationRepository $presentationRepo, Request $request, EntityManagerInterface $em): Response
    {
        // Récupérer la seule présentation
        $presentation = $presentationRepo->findOneBy([]);

        $form = null;

        if ($this->isGranted('ROLE_ADMIN') && $presentation) {
            // Créer le formulaire inline
            $form = $this->createFormBuilder($presentation)
                ->add('descriptionPresentation', TextareaType::class, [
                    'label' => false,
                    'attr' => ['rows' => 5],
                ])
                ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('app_presentation');
            }
        }

        return $this->render('presentation/index.html.twig', [
            'presentation' => $presentation,
            'form' => $form ? $form->createView() : null,
        ]);
    }
}
?>