<?php

namespace App\Entity\Agregat;

use App\Repository\Agregat\ConcassageSaisieDebitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcassageSaisieDebitRepository::class)]
class ConcassageSaisieDebit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeArticle = null;

    #[ORM\Column]
    private ?int $quantite = null;

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