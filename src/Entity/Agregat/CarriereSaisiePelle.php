<?php

namespace App\Entity\Agregat;

use App\Repository\Agregat\AgregatCarriereSaisiePelleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgregatCarriereSaisiePelleRepository::class)]
class CarriereSaisiePelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMateriau = null;

    #[ORM\Column]
    #[Assert\Type(type: 'numeric' , message: 'Veuillez entrer un nombre !')]
    #[Assert\Range(notInRangeMessage: 'Vous devez choisir un nombre entre 0 et 1000 !', min: 0, max: 1000)]
    private ?int $quantite = null;

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
}
