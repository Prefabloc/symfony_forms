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
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qte04 = null; // 04/4cagr - A087mp

    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteCEM = null;  //vishor teralata - ciment2, ciment3

    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteAdjuvant = null; // plastiment-25 sikplastiment25

    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteHuile = null;

    #[ORM\Column(length: 255)]
    #[Assert\Range(minMessage: "Vous ne pouvez pas renseignez un chiffre au dessous de 0 ", min: 0)]
    #[Assert\Type(type: 'float', message: 'Vous devez renseigner un nombre !')]
    private ?float $qteEau = null; // EAU

    #[ORM\OneToOne(mappedBy: 'consommation', cascade: ['persist', 'remove'])]
    private ?PrefablocProduction $prefablocProduction = null;

    #[ORM\Column]
    private ?int $qteArticleProduit = null;

    #[ORM\Column]
    private ?float $qte410c = null; // a087mp

    #[ORM\Column]
    private ?float $qte04cexf = null; // a083mp

    #[ORM\Column(nullable: true)]
    private ?float $qte02c = null;

    #[ORM\Column(length: 255)]
    private ?string $numMoule = null;

    #[ORM\Column(length: 255)]
    private ?string $typeFabrication = null;

    #[ORM\Column(length: 255)]
    private ?string $typeCiment = null;

    // #[ORM\Column(length: 255)]
    // private ?string $typeAdjuvant = null;

    #[ORM\Column]
    private ?float $adjuvant2 = null; // A040mp

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte04(): ?float
    {
        return $this->qte04;
    }

    public function setQte04(float $qte04): static
    {
        $this->qte04 = $qte04;

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

    public function getQteHuile(): ?float
    {
        return $this->qteHuile;
    }

    public function setQteHuile(float $qteHuile): static
    {
        $this->qteHuile = $qteHuile;

        return $this;
    }

    public function getQteEau(): ?float
    {
        return $this->qteEau;
    }

    public function setQteEau(float $qteEau): static
    {
        $this->qteEau = $qteEau;

        return $this;
    }

    public function getPrefablocProduction(): ?PrefablocProduction
    {
        return $this->prefablocProduction;
    }

    public function setPrefablocProduction(?PrefablocProduction $prefablocProduction): static
    {
        // unset the owning side of the relation if necessary
        if ($prefablocProduction === null && $this->prefablocProduction !== null) {
            $this->prefablocProduction->setConsommation(null);
        }

        // set the owning side of the relation if necessary
        if ($prefablocProduction !== null && $prefablocProduction->getConsommation() !== $this) {
            $prefablocProduction->setConsommation($this);
        }

        $this->prefablocProduction = $prefablocProduction;

        return $this;
    }

    public function getQteArticleProduit(): ?int
    {
        return $this->qteArticleProduit;
    }

    public function setQteArticleProduit(int $qteArticleProduit): static
    {
        $this->qteArticleProduit = $qteArticleProduit;

        return $this;
    }

    public function getQte410c(): ?float
    {
        return $this->qte410c;
    }

    public function setQte410c(float $qte410c): static
    {
        $this->qte410c = $qte410c;

        return $this;
    }

    public function getQte04cexf(): ?float
    {
        return $this->qte04cexf;
    }

    public function setQte04cexf(float $qte04cexf): static
    {
        $this->qte04cexf = $qte04cexf;

        return $this;
    }

    public function getQte02c(): ?float
    {
        return $this->qte02c;
    }

    public function setQte02c(?float $qte02c): static
    {
        $this->qte02c = $qte02c;

        return $this;
    }

    public function getNumMoule(): ?string
    {
        return $this->numMoule;
    }

    public function setNumMoule(string $numMoule): static
    {
        $this->numMoule = $numMoule;

        return $this;
    }

    public function getTypeFabrication(): ?string
    {
        return $this->typeFabrication;
    }

    public function setTypeFabrication(string $typeFabrication): static
    {
        $this->typeFabrication = $typeFabrication;

        return $this;
    }

    public function getTypeCiment(): ?string
    {
        return $this->typeCiment;
    }

    public function setTypeCiment(string $typeCiment): static
    {
        $this->typeCiment = $typeCiment;

        return $this;
    }

    // public function getTypeAdjuvant(): ?string
    // {
    //     return $this->typeAdjuvant;
    // }

    // public function setTypeAdjuvant(string $typeAdjuvant): static
    // {
    //     $this->typeAdjuvant = $typeAdjuvant;

    //     return $this;
    // }

    public function getAdjuvant2(): ?float
    {
        return $this->adjuvant2;
    }

    public function setAdjuvant2(float $adjuvant2): static
    {
        $this->adjuvant2 = $adjuvant2;

        return $this;
    }


}
