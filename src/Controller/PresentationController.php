<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Repository\PresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;

class PresentationController extends AbstractController
{
    #[Route('/presentation', name: 'app_presentation')]
    public function index(PresentationRepository $presentationRepo, Request $request, EntityManagerInterface $em): Response
    {
        // Récupération de la présentation (on prend la première trouvée)
        $presentation = $presentationRepo->findOneBy([]);
        if (!$presentation) {
            throw $this->createNotFoundException('Aucune présentation trouvée.');
        }

        // Création du formulaire
        $form = $this->createFormBuilder($presentation)
            ->add('description_presentation', TextareaType::class, [
                'label' => false,
                'attr' => ['rows' => 5, 'class' => 'form-control'],
                'required' => false,
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image de présentation',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Veuillez uploader une image JPEG ou PNG valide.',
                    ]),
                ],
                'attr' => ['class' => 'form-control mt-2'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-warning mt-3 fw-bold'],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // --- Mise à jour de la description ---
            $presentation->setDescriptionPresentation($form->get('description_presentation')->getData());

            // --- Gestion de l'image si un fichier est uploadé ---
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                // Supprimer l'ancienne image si elle existe
                if ($presentation->getImagePresentation()) {
                    $oldPath = $this->getParameter('kernel.project_dir') . '/public/' . ltrim($presentation->getImagePresentation(), '/');
                    if (file_exists($oldPath)) unlink($oldPath);
                }

                // Déplacer le fichier uploadé
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getParameter('image_stockage'), $newFilename);

                // Mettre à jour la propriété image
                $presentation->setImagePresentation('assets/img/' . $newFilename);
            }

            // --- Persister et flush en BDD ---
            $em->persist($presentation);
            $em->flush();

            // Flash message
            $this->addFlash('success', 'Présentation mise à jour avec succès.');

            return $this->redirectToRoute('app_presentation');
        }

        // Rendu du template
        return $this->render('presentation/index.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView(),
        ]);
    }
}
