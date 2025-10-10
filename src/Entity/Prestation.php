<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // ✅ On rend ce champ nullable
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $article = null;

    // ✅ Celui-ci aussi
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'prestations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $Utilisateur_prestation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): static
    {
        $this->article = $article;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }

    public function getUtilisateurPrestation(): ?Utilisateur
    {
        return $this->Utilisateur_prestation;
    }

    public function setUtilisateurPrestation(?Utilisateur $Utilisateur_prestation): static
    {
        $this->Utilisateur_prestation = $Utilisateur_prestation;
        return $this;
    }
}
