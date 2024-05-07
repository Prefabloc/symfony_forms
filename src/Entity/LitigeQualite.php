<?php

namespace App\Entity;

use App\Repository\LitigeQualiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LitigeQualiteRepository::class)]
class LitigeQualite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $societe = null;

    #[ORM\Column(length: 255)]
    private ?string $clients = null;

    #[ORM\Column(length: 255)]
    private ?string $blv = null;

    #[ORM\Column(length: 255)]
    private ?string $article = null;

    #[ORM\Column]
    private ?int $volume = null;

    #[ORM\Column(length: 255)]
    private ?string $conformite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    public function getClients(): ?string
    {
        return $this->clients;
    }

    public function setClients(string $clients): static
    {
        $this->clients = $clients;

        return $this;
    }

    public function getBlv(): ?string
    {
        return $this->blv;
    }

    public function setBlv(string $blv): static
    {
        $this->blv = $blv;

        return $this;
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

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getConformite(): ?string
    {
        return $this->conformite;
    }

    public function setConformite(string $conformite): static
    {
        $this->conformite = $conformite;

        return $this;
    }
}
