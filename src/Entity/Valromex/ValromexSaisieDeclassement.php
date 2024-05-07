<?php

namespace App\Entity\Valromex;

use App\Repository\Valromex\ValromexSaisieDeclassementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ValromexSaisieDeclassementRepository::class)]
class ValromexSaisieDeclassement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $article = null;

    #[ORM\Column(length: 255)]
    private ?string $motifDeclassement = null;

    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir une quantité entre 1 et 1000.", min: 0, max: 1000)]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getMotifDeclassement(): ?string
    {
        return $this->motifDeclassement;
    }

    public function setMotifDeclassement(string $motifDeclassement): static
    {
        $this->motifDeclassement = $motifDeclassement;

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
