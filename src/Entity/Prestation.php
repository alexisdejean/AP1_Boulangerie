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

    #[ORM\Column]
    private ?int $id_prestation = null;

    #[ORM\Column(length: 255)]
    private ?string $article_prestation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image_prestation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPrestation(): ?int
    {
        return $this->id_prestation;
    }

    public function setIdPrestation(int $id_prestation): static
    {
        $this->id_prestation = $id_prestation;

        return $this;
    }

    public function getArticlePrestation(): ?string
    {
        return $this->article_prestation;
    }

    public function setArticlePrestation(string $article_prestation): static
    {
        $this->article_prestation = $article_prestation;

        return $this;
    }

    public function getImagePrestation(): ?string
    {
        return $this->image_prestation;
    }

    public function setImagePrestation(?string $image_prestation): static
    {
        $this->image_prestation = $image_prestation;

        return $this;
    }
}
