<?php

namespace App\Entity\BTP;

use App\Entity\Valromex\ValromexSaisieProduction;
use App\Repository\BTP\BTPProductionRepository;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BTPProductionRepository::class)]
class BTPProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $mode = null;

    #[ORM\OneToOne(inversedBy: 'bTPProduction', cascade: ['persist', 'remove'])]
    private ?ValromexSaisieProduction $SaisieProduction = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $processedAt = null;

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

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getSaisieProduction(): ?ValromexSaisieProduction
    {
        return $this->SaisieProduction;
    }

    public function setSaisieProduction(?ValromexSaisieProduction $SaisieProduction): static
    {
        $this->SaisieProduction = $SaisieProduction;

        return $this;
    }

    public function getProcessedAt(): ?\DateTimeInterface
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTimeInterface $processedAt): static
    {
        $this->processedAt = $processedAt;

        return $this;
    }


}
