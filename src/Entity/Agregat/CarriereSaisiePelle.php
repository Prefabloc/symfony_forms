<?php

namespace App\Entity\Agregat;

use App\Entity\TypeMateriau;
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



    #[ORM\Column]
    #[Assert\Type(type: 'numeric' , message: 'Veuillez entrer un nombre !')]
    #[Assert\Range(notInRangeMessage: 'Vous devez choisir un nombre entre 0 et 1000 !', min: 0, max: 1000)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'carriereSaisiePelles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeMateriau $typeMateriau = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeMateriau(): ?TypeMateriau
    {
        return $this->typeMateriau;
    }

    public function setTypeMateriau(?TypeMateriau $typeMateriau): static
    {
        $this->typeMateriau = $typeMateriau;

        return $this;
    }
}
