<?php

namespace App\Entity;

use App\Entity\Agregat\AgregatCarriereProductionChargeuse;
use App\Entity\Agregat\AgregatCarriereProductionPelle;
use App\Entity\Agregat\AgregatConcassageProductionPelle;
use App\Repository\ModeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeRepository::class)]
class Mode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;



    /**
     * @var Collection<int, AgregatCarriereProductionChargeuse>
     */
    #[ORM\OneToMany(targetEntity: AgregatCarriereProductionChargeuse::class, mappedBy: 'mode')]
    private Collection $agregatCarriereProductionChargeuses;

    /**
     * @var Collection<int, AgregatCarriereProductionPelle>
     */
    #[ORM\OneToMany(targetEntity: AgregatCarriereProductionPelle::class, mappedBy: 'mode')]
    private Collection $agregatCarriereProductionPelles;

    /**
     * @var Collection<int, AgregatConcassageProductionPelle>
     */
    #[ORM\OneToMany(targetEntity: AgregatConcassageProductionPelle::class, mappedBy: 'mode')]
    private Collection $agregatConcassageProductionPelles;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $affiliation = null;

    public function __construct()
    {
        $this->agregatCarriereProductionChargeuses = new ArrayCollection();
        $this->agregatCarriereProductionPelles = new ArrayCollection();
        $this->agregatConcassageProductionPelles = new ArrayCollection();
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
     * @return Collection<int, AgregatCarriereProductionChargeuse>
     */
    public function getAgregatCarriereProductionChargeuses(): Collection
    {
        return $this->agregatCarriereProductionChargeuses;
    }

    public function addAgregatCarriereProductionChargeus(AgregatCarriereProductionChargeuse $agregatCarriereProductionChargeus): static
    {
        if (!$this->agregatCarriereProductionChargeuses->contains($agregatCarriereProductionChargeus)) {
            $this->agregatCarriereProductionChargeuses->add($agregatCarriereProductionChargeus);
            $agregatCarriereProductionChargeus->setMode($this);
        }

        return $this;
    }

    public function removeAgregatCarriereProductionChargeus(AgregatCarriereProductionChargeuse $agregatCarriereProductionChargeus): static
    {
        if ($this->agregatCarriereProductionChargeuses->removeElement($agregatCarriereProductionChargeus)) {
            // set the owning side to null (unless already changed)
            if ($agregatCarriereProductionChargeus->getMode() === $this) {
                $agregatCarriereProductionChargeus->setMode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AgregatCarriereProductionPelle>
     */
    public function getAgregatCarriereProductionPelles(): Collection
    {
        return $this->agregatCarriereProductionPelles;
    }

    public function addAgregatCarriereProductionPelle(AgregatCarriereProductionPelle $agregatCarriereProductionPelle): static
    {
        if (!$this->agregatCarriereProductionPelles->contains($agregatCarriereProductionPelle)) {
            $this->agregatCarriereProductionPelles->add($agregatCarriereProductionPelle);
            $agregatCarriereProductionPelle->setMode($this);
        }

        return $this;
    }

    public function removeAgregatCarriereProductionPelle(AgregatCarriereProductionPelle $agregatCarriereProductionPelle): static
    {
        if ($this->agregatCarriereProductionPelles->removeElement($agregatCarriereProductionPelle)) {
            // set the owning side to null (unless already changed)
            if ($agregatCarriereProductionPelle->getMode() === $this) {
                $agregatCarriereProductionPelle->setMode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AgregatConcassageProductionPelle>
     */
    public function getAgregatConcassageProductionPelles(): Collection
    {
        return $this->agregatConcassageProductionPelles;
    }

    public function addAgregatConcassageProductionPelle(AgregatConcassageProductionPelle $agregatConcassageProductionPelle): static
    {
        if (!$this->agregatConcassageProductionPelles->contains($agregatConcassageProductionPelle)) {
            $this->agregatConcassageProductionPelles->add($agregatConcassageProductionPelle);
            $agregatConcassageProductionPelle->setMode($this);
        }

        return $this;
    }

    public function removeAgregatConcassageProductionPelle(AgregatConcassageProductionPelle $agregatConcassageProductionPelle): static
    {
        if ($this->agregatConcassageProductionPelles->removeElement($agregatConcassageProductionPelle)) {
            // set the owning side to null (unless already changed)
            if ($agregatConcassageProductionPelle->getMode() === $this) {
                $agregatConcassageProductionPelle->setMode(null);
            }
        }

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(?string $affiliation): static
    {
        $this->affiliation = $affiliation;

        return $this;
    }
}
