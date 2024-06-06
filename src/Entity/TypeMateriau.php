<?php

namespace App\Entity;

use App\Entity\Exforman\SaisieAlimentation;
use App\Repository\TypeMateriauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeMateriauRepository::class)]
class TypeMateriau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    /**
     * @var Collection<int, SaisieAlimentation>
     */
    #[ORM\OneToMany(targetEntity: SaisieAlimentation::class, mappedBy: 'typeMateriau')]
    private Collection $saisieAlimentations;

    public function __construct()
    {
        $this->saisieAlimentations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, SaisieAlimentation>
     */
    public function getSaisieAlimentations(): Collection
    {
        return $this->saisieAlimentations;
    }

    public function addSaisieAlimentation(SaisieAlimentation $saisieAlimentation): static
    {
        if (!$this->saisieAlimentations->contains($saisieAlimentation)) {
            $this->saisieAlimentations->add($saisieAlimentation);
            $saisieAlimentation->setTypeMateriau($this);
        }

        return $this;
    }

    public function removeSaisieAlimentation(SaisieAlimentation $saisieAlimentation): static
    {
        if ($this->saisieAlimentations->removeElement($saisieAlimentation)) {
            // set the owning side to null (unless already changed)
            if ($saisieAlimentation->getTypeMateriau() === $this) {
                $saisieAlimentation->setTypeMateriau(null);
            }
        }

        return $this;
    }
}
