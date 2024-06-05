<?php

namespace App\Entity;

use App\Entity\Prefabloc\SaisieDeclassement;
use App\Entity\Valromex\ValromexSaisieDeclassement;
use App\Repository\MotifDeclassementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotifDeclassementRepository::class)]
class MotifDeclassement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $motif = null;

    /**
     * @var Collection<int, SaisieDeclassement>
     */
    #[ORM\OneToMany(targetEntity: SaisieDeclassement::class, mappedBy: 'motifDeclassement')]
    private Collection $saisieDeclassements;

    /**
     * @var Collection<int, ValromexSaisieDeclassement>
     */
    #[ORM\OneToMany(targetEntity: ValromexSaisieDeclassement::class, mappedBy: 'motifDeclassement')]
    private Collection $valromexSaisieDeclassements;




    public function __construct()
    {
        $this->saisieDeclassements = new ArrayCollection();
        $this->valromexSaisieDeclassements = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * @return Collection<int, SaisieDeclassement>
     */
    public function getSaisieDeclassements(): Collection
    {
        return $this->saisieDeclassements;
    }

    public function addSaisieDeclassement(SaisieDeclassement $saisieDeclassement): static
    {
        if (!$this->saisieDeclassements->contains($saisieDeclassement)) {
            $this->saisieDeclassements->add($saisieDeclassement);
            $saisieDeclassement->setMotifDeclassement($this);
        }

        return $this;
    }

    public function removeSaisieDeclassement(SaisieDeclassement $saisieDeclassement): static
    {
        if ($this->saisieDeclassements->removeElement($saisieDeclassement)) {
            // set the owning side to null (unless already changed)
            if ($saisieDeclassement->getMotifDeclassement() === $this) {
                $saisieDeclassement->setMotifDeclassement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ValromexSaisieDeclassement>
     */
    public function getValromexSaisieDeclassements(): Collection
    {
        return $this->valromexSaisieDeclassements;
    }

    public function addValromexSaisieDeclassement(ValromexSaisieDeclassement $valromexSaisieDeclassement): static
    {
        if (!$this->valromexSaisieDeclassements->contains($valromexSaisieDeclassement)) {
            $this->valromexSaisieDeclassements->add($valromexSaisieDeclassement);
            $valromexSaisieDeclassement->setMotifDeclassement($this);
        }

        return $this;
    }

    public function removeValromexSaisieDeclassement(ValromexSaisieDeclassement $valromexSaisieDeclassement): static
    {
        if ($this->valromexSaisieDeclassements->removeElement($valromexSaisieDeclassement)) {
            // set the owning side to null (unless already changed)
            if ($valromexSaisieDeclassement->getMotifDeclassement() === $this) {
                $valromexSaisieDeclassement->setMotifDeclassement(null);
            }
        }

        return $this;
    }
}
