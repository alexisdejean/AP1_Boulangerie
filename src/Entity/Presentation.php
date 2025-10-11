<?php

namespace App\Entity;

use App\Repository\PresentationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresentationRepository::class)]
class Presentation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image_presentation = null;

    #[ORM\Column(length: 255)]
    private ?string $description_presentation = null;

    #[ORM\ManyToOne(inversedBy: 'presentations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $Utilisateur_presentation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagePresentation(): ?string
    {
        return $this->image_presentation;
    }

    public function setImagePresentation(string $image_presentation): static
    {
        $this->image_presentation = $image_presentation;

        return $this;
    }

    public function getDescriptionPresentation(): ?string
    {
        return $this->description_presentation;
    }

    public function setDescriptionPresentation(?string $description_presentation): static
    {
        $this->description_presentation = $description_presentation;
        return $this;
    }


    public function getUtilisateurPresentation(): ?Utilisateur
    {
        return $this->Utilisateur_presentation;
    }

    public function setUtilisateurPresentation(?Utilisateur $Utilisateur_presentation): static
    {
        $this->Utilisateur_presentation = $Utilisateur_presentation;

        return $this;
    }
}
