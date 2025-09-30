<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_user = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_user = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_user = null;

    #[ORM\Column(length: 255)]
    private ?string $mail_user = null;

    #[ORM\Column(length: 255)]
    private ?string $identifiant_user = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp_user = null;

    #[ORM\Column(length: 255)]
    private ?string $type_user = null;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'user_contact')]
    private Collection $contacts;

    /**
     * @var Collection<int, Prestation>
     */
    #[ORM\OneToMany(targetEntity: Prestation::class, mappedBy: 'user_prestation')]
    private Collection $prestations;

    /**
     * @var Collection<int, Presentation>
     */
    #[ORM\OneToMany(targetEntity: Presentation::class, mappedBy: 'user_presentation')]
    private Collection $presentations;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->prestations = new ArrayCollection();
        $this->presentations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setMailUser(string $mail_user): static
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

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setUserContact($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUserContact() === $this) {
                $contact->setUserContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Prestation>
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): static
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations->add($prestation);
            $prestation->setUserPrestation($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): static
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getUserPrestation() === $this) {
                $prestation->setUserPrestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Presentation>
     */
    public function getPresentations(): Collection
    {
        return $this->presentations;
    }

    public function addPresentation(Presentation $presentation): static
    {
        if (!$this->presentations->contains($presentation)) {
            $this->presentations->add($presentation);
            $presentation->setUserPresentation($this);
        }

        return $this;
    }

    public function removePresentation(Presentation $presentation): static
    {
        if ($this->presentations->removeElement($presentation)) {
            // set the owning side to null (unless already changed)
            if ($presentation->getUserPresentation() === $this) {
                $presentation->setUserPresentation(null);
            }
        }

        return $this;
    }
}
