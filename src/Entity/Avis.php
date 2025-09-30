<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_avis = null;

    #[ORM\Column]
    private ?float $note_avis = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire_avis = null;

    #[ORM\Column]
    private ?\DateTime $date_avis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAvis(): ?int
    {
        return $this->id_avis;
    }

    public function setIdAvis(int $id_avis): static
    {
        $this->id_avis = $id_avis;

        return $this;
    }

    public function getNoteAvis(): ?float
    {
        return $this->note_avis;
    }

    public function setNoteAvis(float $note_avis): static
    {
        $this->note_avis = $note_avis;

        return $this;
    }

    public function getCommentaireAvis(): ?string
    {
        return $this->commentaire_avis;
    }

    public function setCommentaireAvis(?string $commentaire_avis): static
    {
        $this->commentaire_avis = $commentaire_avis;

        return $this;
    }

    public function getDateAvis(): ?\DateTime
    {
        return $this->date_avis;
    }

    public function setDateAvis(\DateTime $date_avis): static
    {
        $this->date_avis = $date_avis;

        return $this;
    }
}
