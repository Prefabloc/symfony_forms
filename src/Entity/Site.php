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

    #[ORM\Column(length: 50)]
    private ?string $nomSite = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $noRue = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    /**
     * @var Collection<int, Pointage>
     */
    #[ORM\OneToMany(targetEntity: Pointage::class, mappedBy: 'Site')]
    private Collection $pointages;

    public function __construct()
    {
        $this->pointages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSite(): ?string
    {
        return $this->nomSite;
    }

    public function setNomSite(string $nomSite): static
    {
        $this->nomSite = $nomSite;

        return $this;
    }

    public function getNoRue(): ?string
    {
        return $this->noRue;
    }

    public function setNoRue(?string $noRue): static
    {
        $this->noRue = $noRue;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

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
            $pointage->setSite($this);
        }

        return $this;
    }

    public function removePointage(Pointage $pointage): static
    {
        if ($this->pointages->removeElement($pointage)) {
            // set the owning side to null (unless already changed)
            if ($pointage->getSite() === $this) {
                $pointage->setSite(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nomSite;
    }
}
