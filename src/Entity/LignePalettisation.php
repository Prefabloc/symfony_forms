<?php

namespace App\Entity;

use App\Repository\LignePalettisationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LignePalettisationRepository::class)]
class LignePalettisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[ORM\Column]
    private ?float $nbPalette = null;

    #[ORM\Column]
    private ?float $unite = null;

    #[ORM\ManyToOne(inversedBy: 'lignePalettisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Palettisation $palettisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getNbPalette(): ?float
    {
        return $this->nbPalette;
    }

    public function setNbPalette(float $nbPalette): static
    {
        $this->nbPalette = $nbPalette;

        return $this;
    }

    public function getUnite(): ?float
    {
        return $this->unite;
    }

    public function setUnite(float $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    public function getPalettisation(): ?Palettisation
    {
        return $this->palettisation;
    }

    public function setPalettisation(?Palettisation $palettisation): static
    {
        $this->palettisation = $palettisation;

        return $this;
    }
}
