<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Email comme identifiant pour l’authentification
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $password = null; // mot de passe hashé

    // ---- tes anciens champs ----
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom_user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero_user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_user = null;

    // ---- relations ----
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'user_contact')]
    private Collection $contacts;

    #[ORM\OneToMany(targetEntity: Prestation::class, mappedBy: 'user_prestation')]
    private Collection $prestations;

    #[ORM\OneToMany(targetEntity: Presentation::class, mappedBy: 'user_presentation')]
    private Collection $presentations;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->prestations = new ArrayCollection();
        $this->presentations = new ArrayCollection();
    }

    // --------- Méthodes obligatoires pour Symfony Security ---------
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; // rôle par défaut
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // si tu stockes un mot de passe en clair temporaire, tu peux l'effacer ici
    }

    // --------- Tes getters/setters perso ---------
    public function getNomUser(): ?string { return $this->nom_user; }
    public function setNomUser(?string $nom_user): static { $this->nom_user = $nom_user; return $this; }

    public function getPrenomUser(): ?string { return $this->prenom_user; }
    public function setPrenomUser(?string $prenom_user): static { $this->prenom_user = $prenom_user; return $this; }

    public function getNumeroUser(): ?string { return $this->numero_user; }
    public function setNumeroUser(?string $numero_user): static { $this->numero_user = $numero_user; return $this; }

    public function getTypeUser(): ?string { return $this->type_user; }
    public function setTypeUser(?string $type_user): static { $this->type_user = $type_user; return $this; }

    // --------- Relations ---------
    public function getContacts(): Collection { return $this->contacts; }
    public function addContact(Contact $contact): static { 
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setUserContact($this);
        }
        return $this;
    }
    public function removeContact(Contact $contact): static {
        if ($this->contacts->removeElement($contact)) {
            if ($contact->getUserContact() === $this) {
                $contact->setUserContact(null);
            }
        }
        return $this;
    }

    public function getPrestations(): Collection { return $this->prestations; }
    public function addPrestation(Prestation $prestation): static {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations->add($prestation);
            $prestation->setUserPrestation($this);
        }
        return $this;
    }
    public function removePrestation(Prestation $prestation): static {
        if ($this->prestations->removeElement($prestation)) {
            if ($prestation->getUserPrestation() === $this) {
                $prestation->setUserPrestation(null);
            }
        }
        return $this;
    }

    public function getPresentations(): Collection { return $this->presentations; }
    public function addPresentation(Presentation $presentation): static {
        if (!$this->presentations->contains($presentation)) {
            $this->presentations->add($presentation);
            $presentation->setUserPresentation($this);
        }
        return $this;
    }
    public function removePresentation(Presentation $presentation): static {
        if ($this->presentations->removeElement($presentation)) {
            if ($presentation->getUserPresentation() === $this) {
                $presentation->setUserPresentation(null);
            }
        }
        return $this;
    }
}
