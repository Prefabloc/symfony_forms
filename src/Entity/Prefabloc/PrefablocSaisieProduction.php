<?php

namespace App\Entity\Prefabloc;

use App\Entity\Prefabloc\PrefablocProduction;
use App\Repository\PrefablocSaisieProductionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrefablocSaisieProductionRepository::class)]
class PrefablocSaisieProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $zero_quatre = null;

    #[ORM\Column]
    private ?float $six_dix = null;

    #[ORM\Column]
    private ?float $cem = null;

    #[ORM\Column]
    private ?float $adjuvant = null;

    #[ORM\Column]
    private ?float $huile = null;

    #[ORM\Column]
    private ?float $eau = null;

    #[ORM\OneToOne(inversedBy: 'consommation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?PrefablocProduction $production = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZeroQuatre(): ?float
    {
        return $this->zero_quatre;
    }

    public function setZeroQuatre(float $zero_quatre): static
    {
        $this->zero_quatre = $zero_quatre;

        return $this;
    }

    public function getSixDix(): ?float
    {
        return $this->six_dix;
    }

    public function setSixDix(float $six_dix): static
    {
        $this->six_dix = $six_dix;

        return $this;
    }

    public function getCem(): ?float
    {
        return $this->cem;
    }

    public function setCem(float $cem): static
    {
        $this->cem = $cem;

        return $this;
    }

    public function getAdjuvant(): ?float
    {
        return $this->adjuvant;
    }

    public function setAdjuvant(float $adjuvant): static
    {
        $this->adjuvant = $adjuvant;

        return $this;
    }

    public function getHuile(): ?float
    {
        return $this->huile;
    }

    public function setHuile(float $huile): static
    {
        $this->huile = $huile;

        return $this;
    }

    public function getEau(): ?float
    {
        return $this->eau;
    }

    public function setEau(float $eau): static
    {
        $this->eau = $eau;

        return $this;
    }

    public function getProduction(): ?PrefablocProduction
    {
        return $this->production;
    }

    public function setProduction(PrefablocProduction $production): static
    {
        $this->production = $production;

        return $this;
    }
}
