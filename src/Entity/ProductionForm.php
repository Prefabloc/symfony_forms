<?php

namespace App\Entity;

use App\Entity\Agregat\AgregatCarriereProductionChargeuse;
use App\Entity\Agregat\AgregatCarriereProductionMobile;
use App\Entity\Agregat\AgregatCarriereProductionPelle;
use App\Entity\Agregat\AgregatConcassageProductionChargeuse;
use App\Entity\Agregat\AgregatConcassageProductionPelle;
use App\Entity\BTP\BTPProduction;
use App\Entity\Exforman\ExformanProductionAlimentation;
use App\Entity\Prefabloc\PrefablocProduction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "indicateur", type: "string")]
#[ORM\DiscriminatorMap(
    [
        "prefabloc" => PrefablocProduction::class,
        "btpvalromex" => BTPProduction::class,
        "exforman" => ExformanProductionAlimentation::class,
        "agregat_carriere_chargeuse" => AgregatCarriereProductionChargeuse::class,
        "agregat_carriere_mobile" => AgregatCarriereProductionMobile::class,
        "agregat_carriere_pelle" => AgregatCarriereProductionPelle::class,
        "agregat_concassage_chargeuse" => AgregatConcassageProductionChargeuse::class,
        "agregat_concassage_pelle" => AgregatConcassageProductionPelle::class
    ]
)]
abstract class ProductionForm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThan(propertyPath: 'startedAt', message: "Le moment du début doit être postérieur à celui de la fin !")]
    private ?\DateTimeInterface $endedAt = null;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\OneToMany(targetEntity: Signalement::class, mappedBy: 'productionForm')]
    private Collection $signalements;

    public function __construct()
    {
        $this->signalements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): static
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * @return Collection<int, Signalement>
     */
    public function getSignalements(): Collection
    {
        return $this->signalements;
    }

    public function addSignalement(Signalement $signalement): static
    {
        if (!$this->signalements->contains($signalement)) {
            $this->signalements->add($signalement);
            $signalement->setProductionForm($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): static
    {
        if ($this->signalements->removeElement($signalement)) {
            // set the owning side to null (unless already changed)
            if ($signalement->getProductionForm() === $this) {
                $signalement->setProductionForm(null);
            }
        }

        return $this;
    }
}