<?php

namespace App\Entity;

use App\Repository\PalettisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PalettisationRepository::class)]
class Palettisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @var Collection<int, LignePalettisation>
     */
    #[ORM\OneToMany(targetEntity: LignePalettisation::class, mappedBy: 'palettisation')]
    private Collection $lignePalettisations;

    public function __construct()
    {
        $this->lignePalettisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, LignePalettisation>
     */
    public function getLignePalettisations(): Collection
    {
        return $this->lignePalettisations;
    }

    public function addLignePalettisation(LignePalettisation $lignePalettisation): static
    {
        if (!$this->lignePalettisations->contains($lignePalettisation)) {
            $this->lignePalettisations->add($lignePalettisation);
            $lignePalettisation->setPalettisation($this);
        }

        return $this;
    }

    public function removeLignePalettisation(LignePalettisation $lignePalettisation): static
    {
        if ($this->lignePalettisations->removeElement($lignePalettisation)) {
            // set the owning side to null (unless already changed)
            if ($lignePalettisation->getPalettisation() === $this) {
                $lignePalettisation->setPalettisation(null);
            }
        }

        return $this;
    }
}
