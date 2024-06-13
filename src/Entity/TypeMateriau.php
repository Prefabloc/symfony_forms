<?php

namespace App\Entity;

use App\Entity\Agregat\CarriereSaisiePelle;
use App\Entity\Agregat\ConcassageSaisiePelle;
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

    /**
     * @var Collection<int, CarriereSaisiePelle>
     */
    #[ORM\OneToMany(targetEntity: CarriereSaisiePelle::class, mappedBy: 'typeMateriau')]
    private Collection $carriereSaisiePelles;

    /**
     * @var Collection<int, ConcassageSaisiePelle>
     */
    #[ORM\OneToMany(targetEntity: ConcassageSaisiePelle::class, mappedBy: 'typeMateriau')]
    private Collection $concassageSaisiePelles;

    public function __construct()
    {
        $this->saisieAlimentations = new ArrayCollection();
        $this->carriereSaisiePelles = new ArrayCollection();
        $this->concassageSaisiePelles = new ArrayCollection();
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

    /**
     * @return Collection<int, CarriereSaisiePelle>
     */
    public function getCarriereSaisiePelles(): Collection
    {
        return $this->carriereSaisiePelles;
    }

    public function addCarriereSaisiePelle(CarriereSaisiePelle $carriereSaisiePelle): static
    {
        if (!$this->carriereSaisiePelles->contains($carriereSaisiePelle)) {
            $this->carriereSaisiePelles->add($carriereSaisiePelle);
            $carriereSaisiePelle->setTypeMateriau($this);
        }

        return $this;
    }

    public function removeCarriereSaisiePelle(CarriereSaisiePelle $carriereSaisiePelle): static
    {
        if ($this->carriereSaisiePelles->removeElement($carriereSaisiePelle)) {
            // set the owning side to null (unless already changed)
            if ($carriereSaisiePelle->getTypeMateriau() === $this) {
                $carriereSaisiePelle->setTypeMateriau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ConcassageSaisiePelle>
     */
    public function getConcassageSaisiePelles(): Collection
    {
        return $this->concassageSaisiePelles;
    }

    public function addConcassageSaisiePelle(ConcassageSaisiePelle $concassageSaisiePelle): static
    {
        if (!$this->concassageSaisiePelles->contains($concassageSaisiePelle)) {
            $this->concassageSaisiePelles->add($concassageSaisiePelle);
            $concassageSaisiePelle->setTypeMateriau($this);
        }

        return $this;
    }

    public function removeConcassageSaisiePelle(ConcassageSaisiePelle $concassageSaisiePelle): static
    {
        if ($this->concassageSaisiePelles->removeElement($concassageSaisiePelle)) {
            // set the owning side to null (unless already changed)
            if ($concassageSaisiePelle->getTypeMateriau() === $this) {
                $concassageSaisiePelle->setTypeMateriau(null);
            }
        }

        return $this;
    }
}
