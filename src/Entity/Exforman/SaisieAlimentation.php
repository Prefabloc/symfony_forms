<?php

namespace App\Entity\Exforman;

use App\Entity\TypeMateriau;
use App\Repository\Exforman\SaisieAlimentationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SaisieAlimentationRepository::class)]
class SaisieAlimentation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir un poids entre 1 et 1000 tonnes", min: 0, max: 1000)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'saisieAlimentations')]
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
