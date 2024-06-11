<?php

namespace App\Entity\Agregat;

use App\Entity\ProductionForm;
use App\Repository\AgregatCarriereProductionPelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatCarriereProductionPelleRepository::class)]
class AgregatCarriereProductionPelle extends ProductionForm
{
    #[ORM\Column(length: 255)]
    private ?string $mode = null;

    #[ORM\OneToOne(mappedBy: 'production', cascade: ['persist', 'remove'])]
    private ?CarriereSaisiePelle $carriereSaisiePelle = null;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getCarriereSaisiePelle(): ?CarriereSaisiePelle
    {
        return $this->carriereSaisiePelle;
    }

    public function setCarriereSaisiePelle(CarriereSaisiePelle $carriereSaisiePelle): static
    {
        // set the owning side of the relation if necessary
        if ($carriereSaisiePelle->getProduction() !== $this) {
            $carriereSaisiePelle->setProduction($this);
        }

        $this->carriereSaisiePelle = $carriereSaisiePelle;

        return $this;
    }

}
