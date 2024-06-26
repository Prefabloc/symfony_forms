<?php

namespace App\Entity;

use App\Repository\ConsommationEauRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsommationEauRepository::class)]
class ConsommationEau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'consommationEaus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompteurDeau $compteur = null;

    #[ORM\Column]
    private ?float $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteur(): ?CompteurDeau
    {
        return $this->compteur;
    }

    public function setCompteur(?CompteurDeau $compteur): static
    {
        $this->compteur = $compteur;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }
}
