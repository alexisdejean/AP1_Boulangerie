<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Repository\PrestationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'app_prestation')]
    public function index(
        Request $request,
        PrestationRepository $prestationRepository,
        EntityManagerInterface $em
    ): Response {
        $prestation = new Prestation();

        $form = $this->createFormBuilder($prestation)
            ->add('article', TextareaType::class, [
                'label' => 'Texte de la prestation',
                'required' => false,
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image de la prestation (facultative)',
                'mapped' => false,
                'required' => false,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $imageFile */
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $fileName = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getParameter('kernel.project_dir') . '/public/uploads', $fileName);
                $prestation->setImage('uploads/' . $fileName);
            }

            $prestation->setUtilisateurPrestation($this->getUser());

            $em->persist($prestation);
            $em->flush();

            $this->addFlash('success', 'Article ajouté avec succès ! Vous pouvez en ajouter un autre.');

            // Recharger la page pour permettre d’ajouter un autre article
            return $this->redirectToRoute('app_prestation');
        }

        // Toutes les prestations (pour affichage public)
        $prestations = $prestationRepository->findAll();

        return $this->render('prestation/index.html.twig', [
            'form' => $form->createView(),
            'prestations' => $prestations,
        ]);
    }
}
