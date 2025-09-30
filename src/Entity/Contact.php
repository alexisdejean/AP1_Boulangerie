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

    #[ORM\Column]
    private ?int $id_contact = null;

    #[ORM\Column]
    private ?int $numero_contact = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $demande_contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdContact(): ?int
    {
        return $this->id_contact;
    }

    public function setIdContact(int $id_contact): static
    {
        $this->id_contact = $id_contact;

        return $this;
    }

    public function getNumeroContact(): ?int
    {
        return $this->numero_contact;
    }

    public function setNumeroContact(int $numero_contact): static
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
}
