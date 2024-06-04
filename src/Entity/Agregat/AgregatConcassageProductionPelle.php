<?php

namespace App\Entity\Agregat;

use App\Entity\ProductionForm;
use App\Repository\AgregatConcassageProductionPelleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatConcassageProductionPelleRepository::class)]
class AgregatConcassageProductionPelle extends ProductionForm
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
