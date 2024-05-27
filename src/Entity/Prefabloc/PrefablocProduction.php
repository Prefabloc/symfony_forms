<?php

namespace App\Entity\Prefabloc;


use App\Entity\Article;
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

    #[ORM\OneToOne(mappedBy: 'production', cascade: ['persist', 'remove'])]
    private ?SaisieProduction $consommation = null;

    #[ORM\ManyToOne(inversedBy: 'prefablocProductions')]
    private ?Article $article = null;

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


    public function getConsommation(): ?SaisieProduction
    {
        return $this->consommation;
    }

    public function setConsommation(SaisieProduction $consommation): static
    {
        // set the owning side of the relation if necessary
        if ($consommation->getProduction() !== $this) {
            $consommation->setProduction($this);
        }

        $this->consommation = $consommation;

        return $this;
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
}
