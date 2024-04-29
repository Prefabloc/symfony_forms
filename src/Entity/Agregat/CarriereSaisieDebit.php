<?php

namespace App\Entity\Agregat;

use App\Repository\AgregatCarriereSaisieDebitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarriereSaisieDebitRepository::class)]
class CarriereSaisieDebit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeArticle = null;

    #[ORM\Column(length: 50)]
    #[Assert\Type(type: "integer" , message: "Vous devez entrer une valeur entière")]
    #[Assert\Range( notInRangeMessage: "Vous devez choisir un poids entre 0 et 1000 tonnes !", min: "0", max: "1000")]
    private ?int $NombreTonne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeArticle(): ?string
    {
        return $this->TypeArticle;
    }

    public function setTypeArticle(string $TypeArticle): static
    {
        $this->TypeArticle = $TypeArticle;

        return $this;
    }

    public function getNombreTonne(): ?int
    {
        return $this->NombreTonne;
    }

    public function setNombreTonne(int $NombreTonne): static
    {
        $this->NombreTonne = $NombreTonne;

        return $this;
    }
}
