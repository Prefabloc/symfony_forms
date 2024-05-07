<?php

namespace App\Entity\Prefabloc;

use App\Repository\Prefabloc\SaisieProductionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SaisieProductionRepository::class)]
class SaisieProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Renseignez une valeur svp !")]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un entier !')]
    private ?float $qte04 = null;

    #[ORM\Column(length: 255)]
    private ?string $qte610 = null;

    #[ORM\Column(length: 255)]
    private ?string $qteCEM = null;

    #[ORM\Column(length: 255)]
    private ?string $qteAdjuvant = null;

    #[ORM\Column(length: 255)]
    private ?string $qteHuile = null;

    #[ORM\Column(length: 255)]
    private ?string $qteEau = null;

    #[ORM\OneToOne(inversedBy: 'saisieProduction', cascade: ['persist', 'remove'])]
    private ?PrefablocProduction $PrefablocProduction = null;

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

    public function getPrefablocProduction(): ?PrefablocProduction
    {
        return $this->PrefablocProduction;
    }

    public function setPrefablocProduction(?PrefablocProduction $PrefablocProduction): static
    {
        $this->PrefablocProduction = $PrefablocProduction;

        return $this;
    }
}
