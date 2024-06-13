<?php

namespace App\Entity\Agregat;

use App\Entity\ProductionForm;
use App\Repository\Agregat\AgregatCarriereProductionMobileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatCarriereProductionMobileRepository::class)]
class AgregatCarriereProductionMobile extends ProductionForm
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etage1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etage2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etage3 = null;

    public function getEtage1(): ?string
    {
        return $this->etage1;
    }

    public function setEtage1(?string $etage1): static
    {
        $this->etage1 = $etage1;

        return $this;
    }

    public function getEtage2(): ?string
    {
        return $this->etage2;
    }

    public function setEtage2(?string $etage2): static
    {
        $this->etage2 = $etage2;

        return $this;
    }

    public function getEtage3(): ?string
    {
        return $this->etage3;
    }

    public function setEtage3(?string $etage3): static
    {
        $this->etage3 = $etage3;

        return $this;
    }
}
