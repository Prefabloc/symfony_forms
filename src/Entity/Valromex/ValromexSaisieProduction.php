<?php

namespace App\Entity\Valromex;

use App\Entity\BTP\BTPProduction;
use App\Repository\Valromex\ValromexSaisieProductionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ValromexSaisieProductionRepository::class)]
class ValromexSaisieProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Renseignez une valeur svp !")]
    #[Assert\Range(  notInRangeMessage: 'Vous ne pouvez pas mettre moins de 0 ou plus de 10 000', min: 0, max: 10000)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qte04 = null;

    #[ORM\Column(length: 255)]
    #[Assert\Range(  notInRangeMessage: 'Vous ne pouvez pas mettre moins de 0 ou plus de 10 000', min: 0, max: 10000)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qte610 = null;

    #[ORM\Column(length: 255)]
    #[Assert\Range(  notInRangeMessage: 'Vous ne pouvez pas mettre moins de 0 ou plus de 10 000', min: 0, max: 10000)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteCEM = null;

    #[ORM\Column(length: 255)]
    #[Assert\Range(  notInRangeMessage: 'Vous ne pouvez pas mettre moins de 0 ou plus de 10 000', min: 0, max: 10000)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteAdjuvant = null;

    #[ORM\Column(length: 255)]
    #[Assert\Range(  notInRangeMessage: 'Vous ne pouvez pas mettre moins de 0 ou plus de 10 000', min: 0, max: 10000)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteHuile = null;

    #[ORM\Column(length: 255)]
    #[Assert\Range(  notInRangeMessage: 'Vous ne pouvez pas mettre moins de 0 ou plus de 10 000', min: 0, max: 10000)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteEau = null;

    #[ORM\OneToOne(mappedBy: 'SaisieProduction', cascade: ['persist', 'remove'])]
    private ?BTPProduction $bTPProduction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte04(): ?string
    {
        return $this->qte04;
    }

    public function setQte04(string $qte04): static
    {
        $this->qte04 = $qte04;

        return $this;
    }

    public function getQte610(): ?string
    {
        return $this->qte610;
    }

    public function setQte610(string $qte610): static
    {
        $this->qte610 = $qte610;

        return $this;
    }

    public function getQteCEM(): ?string
    {
        return $this->qteCEM;
    }

    public function setQteCEM(string $qteCEM): static
    {
        $this->qteCEM = $qteCEM;

        return $this;
    }

    public function getQteAdjuvant(): ?string
    {
        return $this->qteAdjuvant;
    }

    public function setQteAdjuvant(string $qteAdjuvant): static
    {
        $this->qteAdjuvant = $qteAdjuvant;

        return $this;
    }

    public function getQteHuile(): ?string
    {
        return $this->qteHuile;
    }

    public function setQteHuile(string $qteHuile): static
    {
        $this->qteHuile = $qteHuile;

        return $this;
    }

    public function getQteEau(): ?string
    {
        return $this->qteEau;
    }

    public function setQteEau(string $qteEau): static
    {
        $this->qteEau = $qteEau;

        return $this;
    }

    public function getBTPProduction(): ?BTPProduction
    {
        return $this->bTPProduction;
    }

    public function setBTPProduction(?BTPProduction $bTPProduction): static
    {
        // unset the owning side of the relation if necessary
        if ($bTPProduction === null && $this->bTPProduction !== null) {
            $this->bTPProduction->setSaisieProduction(null);
        }

        // set the owning side of the relation if necessary
        if ($bTPProduction !== null && $bTPProduction->getSaisieProduction() !== $this) {
            $bTPProduction->setSaisieProduction($this);
        }

        $this->bTPProduction = $bTPProduction;

        return $this;
    }
}
