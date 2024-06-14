<?php

namespace App\Entity;

use App\Repository\ConsommationEssenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsommationEssenceRepository::class)]
class ConsommationEssence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    private ?float $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'consommationEssences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Machine $machine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoCompteurCarburant = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMachine(): ?Machine
    {
        return $this->machine;
    }

    public function setMachine(?Machine $machine): static
    {
        $this->machine = $machine;

        return $this;
    }

    public function getPhotoCompteurCarburant(): ?string
    {
        return $this->photoCompteurCarburant;
    }

    public function setPhotoCompteurCarburant(?string $photoCompteurCarburant): static
    {
        $this->photoCompteurCarburant = $photoCompteurCarburant;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}