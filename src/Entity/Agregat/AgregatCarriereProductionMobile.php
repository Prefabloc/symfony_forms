<?php

namespace App\Entity\Agregat;

use App\Repository\AgregatCarriereProductionMobileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatCarriereProductionMobileRepository::class)]
class AgregatCarriereProductionMobile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etage1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etage2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etage3 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): static
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getEtage1(): ?string
    {
        return $this->etage1;
    }

    public function setEtage1(?string $etage1): static
    {
        $this->etage1 = $etage1;

        return $this;
    }

    public function getEtage2(): ?string
    {
        return $this->etage2;
    }

    public function setEtage2(?string $etage2): static
    {
        $this->etage2 = $etage2;

        return $this;
    }

    public function getEtage3(): ?string
    {
        return $this->etage3;
    }

    public function setEtage3(?string $etage3): static
    {
        $this->etage3 = $etage3;

        return $this;
    }
}
