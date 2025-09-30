<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_user = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_user = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_user = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail_user = null;

    #[ORM\Column(length: 255)]
    private ?string $identifiant_user = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp_user = null;

    #[ORM\Column(length: 255)]
    private ?string $type_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }

    public function setNomUser(string $nom_user): static
    {
        $this->nom_user = $nom_user;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenom_user;
    }

    public function setPrenomUser(string $prenom_user): static
    {
        $this->prenom_user = $prenom_user;

        return $this;
    }

    public function getNumeroUser(): ?string
    {
        return $this->numero_user;
    }

    public function setNumeroUser(string $numero_user): static
    {
        $this->numero_user = $numero_user;

        return $this;
    }

    public function getMailUser(): ?string
    {
        return $this->mail_user;
    }

    public function setMailUser(?string $mail_user): static
    {
        $this->mail_user = $mail_user;

        return $this;
    }

    public function getIdentifiantUser(): ?string
    {
        return $this->identifiant_user;
    }

    public function setIdentifiantUser(string $identifiant_user): static
    {
        $this->identifiant_user = $identifiant_user;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdp_user;
    }

    public function setMdpUser(string $mdp_user): static
    {
        $this->mdp_user = $mdp_user;

        return $this;
    }

    public function getTypeUser(): ?string
    {
        return $this->type_user;
    }

    public function setTypeUser(string $type_user): static
    {
        $this->type_user = $type_user;

        return $this;
    }
}
