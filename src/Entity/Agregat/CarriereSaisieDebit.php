<?php

namespace App\Entity\Agregat;

use App\Repository\Agregat\CarriereSaisieDebitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarriereSaisieDebitRepository::class)]
class CarriereSaisieDebit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeArticle = null;

    #[ORM\Column(length: 255 )]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir un poids entre 1 et 1000 tonnes", min: 0, max: 1000)]
    private ?string $nbrTonne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeArticle(): ?string
    {
        return $this->typeArticle;
    }

    public function setTypeArticle(string $typeArticle): static
    {
        $this->typeArticle = $typeArticle;

        return $this;
    }

    public function getNbrTonne(): ?string
    {
        return $this->nbrTonne;
    }

    public function setNbrTonne(string $nbrTonne): static
    {
        $this->nbrTonne = $nbrTonne;

        return $this;
    }
}
