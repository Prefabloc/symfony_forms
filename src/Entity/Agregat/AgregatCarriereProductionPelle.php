<?php

namespace App\Entity\Agregat;

use App\Entity\Mode;
use App\Entity\ProductionForm;
use App\Repository\Agregat\AgregatCarriereProductionPelleRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatCarriereProductionPelleRepository::class)]
class AgregatCarriereProductionPelle extends ProductionForm
{


    #[ORM\OneToOne(mappedBy: 'production', cascade: ['persist', 'remove'])]
    private ?CarriereSaisiePelle $carriereSaisiePelle = null;

    #[ORM\ManyToOne(inversedBy: 'agregatCarriereProductionPelles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mode $mode = null;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
