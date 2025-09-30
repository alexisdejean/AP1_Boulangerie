<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $numero_contact = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $demande_contact = null;

    #[ORM\Column]
    private ?\DateTime $date_contact = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroContact(): ?string
    {
        return $this->numero_contact;
    }

    public function setNumeroContact(string $numero_contact): static
    {
        $this->numero_contact = $numero_contact;

        return $this;
    }

    public function getDemandeContact(): ?string
    {
        return $this->demande_contact;
    }

    public function setDemandeContact(string $demande_contact): static
    {
        $this->demande_contact = $demande_contact;

        return $this;
    }

    public function getDateContact(): ?\DateTime
    {
        return $this->date_contact;
    }

    public function setDateContact(\DateTime $date_contact): static
    {
        $this->date_contact = $date_contact;

        return $this;
    }

    public function getUserContact(): ?user
    {
        return $this->user_contact;
    }

    public function setUserContact(?user $user_contact): static
    {
        $this->user_contact = $user_contact;

        return $this;
    }
}
