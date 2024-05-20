<?php

namespace App\Entity\Prefabloc;

use App\Repository\Prefabloc\SaisieProductionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SaisieProductionRepository::class)]
class SaisieProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["consommable"])]
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Renseignez une valeur svp !")]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qte04 = null;

    #[Groups(["consommable"])]
    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qte610 = null;

    #[Groups(["consommable"])]
    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteCEM = null;

    #[Groups(["consommable"])]
    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteAdjuvant = null;

    #[Groups(["consommable"])]
    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteHuile = null;

    #[Groups(["consommable"])]
    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteEau = null;

    #[Ignore]
    #[ORM\OneToOne(inversedBy: 'saisieProduction', cascade: ['persist', 'remove'])]
    private ?PrefablocProduction $PrefablocProduction = null;

    #[ORM\Column]
    private ?float $qteArticleProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte04(): ?string
    {
        return $this->qte04;
    }

    public function setQte04(float $qte04): static
    {
        $this->qte04 = $qte04;

        return $this;
    }

    public function getQte610(): ?float
    {
        return $this->qte610;
    }

    public function setQte610(float $qte610): static
    {
        $this->qte610 = $qte610;

        return $this;
    }

    public function getQteCEM(): ?float
    {
        return $this->qteCEM;
    }

    public function setQteCEM(float $qteCEM): static
    {
        $this->qteCEM = $qteCEM;

        return $this;
    }

    public function getQteAdjuvant(): ?float
    {
        return $this->qteAdjuvant;
    }

    public function setQteAdjuvant(float $qteAdjuvant): static
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

    public function getQteArticleProduit(): ?float
    {
        return $this->qteArticleProduit;
    }

    public function setQteArticleProduit(float $qteArticleProduit): static
    {
        $this->qteArticleProduit = $qteArticleProduit;

        return $this;
    }
}
