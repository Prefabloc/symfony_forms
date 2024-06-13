<?php

namespace App\Entity;

use App\Repository\LitigeQualiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LitigeQualiteRepository::class)]
class LitigeQualite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'litigeQualites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un client !')]
    #[Assert\Length(min: 1, max: 50,
        minMessage: 'Vous devez saisir au moins un caractère !',
        maxMessage: 'Vous devez saisir moins de 51 caractères !')]
    private ?string $clients = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un numéro de bon de livraison !')]
    private ?string $blv = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un article !')]
    private ?string $article = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    private ?int $volume = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un motif de non conformité !')]
    private ?string $conformite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
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