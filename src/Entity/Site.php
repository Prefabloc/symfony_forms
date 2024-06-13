<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, IdentificationPrestation>
     */
    #[ORM\OneToMany(targetEntity: IdentificationPrestation::class, mappedBy: 'site')]
    private Collection $identificationPrestations;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $adresse = null;

    public function __construct()
    {
        $this->identificationPrestations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, IdentificationPrestation>
     */
    public function getIdentificationPrestations(): Collection
    {
        return $this->identificationPrestations;
    }

    public function addIdentificationPrestation(IdentificationPrestation $identificationPrestation): static
    {
        if (!$this->identificationPrestations->contains($identificationPrestation)) {
            $this->identificationPrestations->add($identificationPrestation);
            $identificationPrestation->setSite($this);
        }

        return $this;
    }

    public function removeIdentificationPrestation(IdentificationPrestation $identificationPrestation): static
    {
        if ($this->identificationPrestations->removeElement($identificationPrestation)) {
            // set the owning side to null (unless already changed)
            if ($identificationPrestation->getSite() === $this) {
                $identificationPrestation->setSite(null);
            }
        }

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }
}
