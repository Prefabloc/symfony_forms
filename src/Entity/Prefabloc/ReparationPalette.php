<?php

namespace App\Entity\Prefabloc;

use App\Entity\Article;
use App\Repository\Prefabloc\RepartitionPaletteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RepartitionPaletteRepository::class)]
class ReparationPalette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir une quantité entre 0 et 1000", min: 0, max: 1000)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'reparationPalettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $typePalette = null;

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

    public function getTypePalette(): ?Article
    {
        return $this->typePalette;
    }

    public function setTypePalette(?Article $typePalette): static
    {
        $this->typePalette = $typePalette;

        return $this;
    }
}
