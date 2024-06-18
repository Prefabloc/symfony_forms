<?php

namespace App\Entity\Agregat;

use App\Entity\Mode;
use App\Entity\ProductionForm;
use App\Repository\Agregat\AgregatConcassageProductionPelleRepository;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatConcassageProductionPelleRepository::class)]
class AgregatConcassageProductionPelle extends ProductionForm
{
    #[ORM\ManyToOne(inversedBy: 'agregatConcassageProductionPelles')]
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
