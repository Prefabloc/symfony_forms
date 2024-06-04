<?php

namespace App\Entity\Agregat;

use App\Entity\ProductionForm;
use App\Repository\Agregat\AgregatCarriereProductionChargeuseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgregatCarriereProductionChargeuseRepository::class)]
class AgregatCarriereProductionChargeuse extends ProductionForm
{
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $mode = null;

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): static
    {
        $this->mode = $mode;

        return $this;
    }
}
