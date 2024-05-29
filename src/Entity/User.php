<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['username'], message: 'Il y a déjà un compte avec cet identifiant !')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un identifiant !')]
    #[Assert\Length(min: 1, max: 30 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 30 caractères !")]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank(message: 'Vous devez renseigner un mot de passe !')]
    #[Assert\Length(min: 1, max: 30 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 31 caractères !")]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un nom !')]
    #[Assert\Length(min: 1, max: 30 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 31 caractères !")]
    #[Assert\Regex(pattern: "/^[\p{L}\s'-]+$/u" , message: "Vous ne pouvez pas avoir de lettres dans votre nom / prénom !")]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un prénom !')]
    #[Assert\Length(min: 1, max: 30 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 31 caractères !")]
    #[Assert\Regex(pattern: "/^[\p{L}\s'-]+$/u" , message: "Vous ne pouvez pas avoir de lettres dans votre nom / prénom !")]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[Assert\Valid()]
    private ?Societe $societe = null;

    /**
     * @var Collection<int, HistoriqueActionsArticle>
     */
    #[ORM\OneToMany(targetEntity: HistoriqueActionsArticle::class, mappedBy: 'personneModifiant')]
    private Collection $historiqueActionsArticles;

    /**
     * @var Collection<int, Pointage>
     */
    #[ORM\OneToMany(targetEntity: Pointage::class, mappedBy: 'employe', orphanRemoval: true)]
    private Collection $pointages;

    public function __construct()
    {
        $this->historiqueActionsArticles = new ArrayCollection();
        $this->pointages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * @return Collection<int, HistoriqueActionsArticle>
     */
    public function getHistoriqueActionsArticles(): Collection
    {
        return $this->historiqueActionsArticles;
    }

    public function addHistoriqueActionsArticle(HistoriqueActionsArticle $historiqueActionsArticle): static
    {
        if (!$this->historiqueActionsArticles->contains($historiqueActionsArticle)) {
            $this->historiqueActionsArticles->add($historiqueActionsArticle);
            $historiqueActionsArticle->setPersonneModifiant($this);
        }

        return $this;
    }

    public function removeHistoriqueActionsArticle(HistoriqueActionsArticle $historiqueActionsArticle): static
    {
        if ($this->historiqueActionsArticles->removeElement($historiqueActionsArticle)) {
            // set the owning side to null (unless already changed)
            if ($historiqueActionsArticle->getPersonneModifiant() === $this) {
                $historiqueActionsArticle->setPersonneModifiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pointage>
     */
    public function getPointages(): Collection
    {
        return $this->pointages;
    }

    public function addPointage(Pointage $pointage): static
    {
        if (!$this->pointages->contains($pointage)) {
            $this->pointages->add($pointage);
            $pointage->setEmploye($this);
        }

        return $this;
    }

    public function removePointage(Pointage $pointage): static
    {
        if ($this->pointages->removeElement($pointage)) {
            // set the owning side to null (unless already changed)
            if ($pointage->getEmploye() === $this) {
                $pointage->setEmploye(null);
            }
        }

        return $this;
    }
}
