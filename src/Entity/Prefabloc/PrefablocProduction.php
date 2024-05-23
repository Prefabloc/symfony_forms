<?php

namespace App\Entity\Prefabloc;


use App\Entity\ProductionArticle;
use App\Repository\Prefabloc\PrefablocProductionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrefablocProductionRepository::class)]
class PrefablocProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endedAt = null;

    #[ORM\OneToOne(mappedBy: 'PrefablocProduction', cascade: ['persist', 'remove'])]
    private ?SaisieProduction $consommation = null;

    #[ORM\OneToOne(mappedBy: 'PrefablocProduction', cascade: ['persist', 'remove'])]
    private ?SaisieProduction $saisieProduction = null;

    #[ORM\ManyToOne(inversedBy: 'prefablocProductions')]
    private ?ProductionArticle $article = null;

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

    public function getConsommation(): ?PrefablocSaisieProduction
    {
        return $this->consommation;
    }

    public function setConsommation(PrefablocSaisieProduction $consommation): static
    {
        // set the owning side of the relation if necessary
        if ($consommation->getProduction() !== $this) {
            $consommation->setProduction($this);
        }

        $this->consommation = $consommation;

        return $this;
    }

    public function getSaisieProduction(): ?SaisieProduction
    {
        return $this->saisieProduction;
    }

    public function setSaisieProduction(?SaisieProduction $saisieProduction): static
    {
        // unset the owning side of the relation if necessary
        if ($saisieProduction === null && $this->saisieProduction !== null) {
            $this->saisieProduction->setPrefablocProduction(null);
        }

        // set the owning side of the relation if necessary
        if ($saisieProduction !== null && $saisieProduction->getPrefablocProduction() !== $this) {
            $saisieProduction->setPrefablocProduction($this);
        }

        $this->saisieProduction = $saisieProduction;

        return $this;
    }

    public function getArticle(): ?ProductionArticle
    {
        return $this->article;
    }

    public function setArticle(?ProductionArticle $article): static
    {
        $this->article = $article;

        return $this;
    }
}
