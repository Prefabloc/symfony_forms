<?php

namespace App\Entity\Agregat;

use App\Repository\Agregat\ConcassageSaisiePelleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ConcassageSaisiePelleRepository::class)]
class ConcassageSaisiePelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMateriau = null;

    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir un poids entre 1 et 1000 tonnes", min: 0, max: 1000)]
    private ?int $quantite = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AgregatConcassageProductionPelle $production = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeMateriau(): ?string
    {
        return $this->typeMateriau;
    }

    public function setTypeMateriau(string $typeMateriau): static
    {
        $this->typeMateriau = $typeMateriau;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getProduction(): ?AgregatConcassageProductionPelle
    {
        return $this->production;
    }

    public function setProduction(AgregatConcassageProductionPelle $production): static
    {
        $this->production = $production;

        return $this;
    }
}
