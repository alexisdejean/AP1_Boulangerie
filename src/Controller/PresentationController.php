<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
            $form = $this->createFormBuilder($presentation)
                ->add('descriptionPresentation', TextareaType::class, [
                    'label' => false,
                    'attr' => ['rows' => 5],
                ])
                ->add('imageFile', FileType::class, [
                    'label' => 'Image de présentation',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '2M',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png',
                            ],
                            'mimeTypesMessage' => 'Veuillez uploader un fichier JPEG ou PNG valide',
                        ])
                    ],
                ])
                ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $imageFile = $form->get('imageFile')->getData();

                if ($imageFile) {
                    $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                    try {
                        $imageFile->move(
                            $this->getParameter('image_stockage'), // dossier physique
                            $newFilename
                        );
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors de l’upload de l’image');
                    }
                    // chemin relatif pour Twig / base de données
                    $presentation->setImagePresentation('assets/img/' . $newFilename);
                }

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
