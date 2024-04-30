<?php

namespace App\Entity\Prefabloc;

use App\Repository\Prefabloc\RepartitionPaletteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepartitionPaletteRepository::class)]
class RepartitionPalette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typePalette = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePalette(): ?string
    {
        return $this->typePalette;
    }

    public function setTypePalette(string $typePalette): static
    {
        $this->typePalette = $typePalette;

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
