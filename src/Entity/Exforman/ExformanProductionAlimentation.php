<?php

namespace App\Entity\Exforman;

use App\Entity\ProductionForm;
use App\Repository\ExformanProductionAlimentationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExformanProductionAlimentationRepository::class)]
class ExformanProductionAlimentation extends ProductionForm
{
    #[ORM\Column(length: 255)]
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
