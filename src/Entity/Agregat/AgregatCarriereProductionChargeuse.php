<?php

namespace App\Entity\Agregat;

use App\Entity\Mode;
use App\Entity\ProductionForm;
use App\Repository\Agregat\AgregatCarriereProductionChargeuseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgregatCarriereProductionChargeuseRepository::class)]
class AgregatCarriereProductionChargeuse extends ProductionForm
{
    #[ORM\ManyToOne(inversedBy: 'agregatCarriereProductionChargeuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mode $mode = null;

    public function getMode(): ?Mode
    {
        return $this->mode;
    }

    public function setMode(?Mode $mode): static
    {
        $this->mode = $mode;

        return $this;
    }
}
