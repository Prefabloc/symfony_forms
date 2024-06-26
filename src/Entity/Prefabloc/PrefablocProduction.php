<?php

namespace App\Entity\Prefabloc;


use App\Entity\Article;
use App\Entity\ProductionForm;
use App\Repository\Prefabloc\PrefablocProductionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PrefablocProductionRepository::class)]
class PrefablocProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'prefablocProductions')]
    #[Assert\Valid()]
    private ?Article $article = null;

    #[ORM\OneToOne(inversedBy: 'prefablocProduction', cascade: ['persist', 'remove'])]
    private ?SaisieProduction $consommation = null;

    #[ORM\OneToOne(inversedBy: 'prefablocProduction', cascade: ['persist', 'remove'])]
    private ?SaisieProductionInfo $consommationInfo = null;

    public function getId()
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

    public function getConsommation(): ?SaisieProduction
    {
        return $this->consommation;
    }

    public function setConsommation(?SaisieProduction $consommation): static
    {
        $this->consommation = $consommation;

        return $this;
    }


    public function getConsommationInfo(): ?SaisieProductionInfo
    {
        return $this->consommationInfo;
    }

    public function setConsommationInfo(?SaisieProductionInfo $consommationInfo): static
    {
        $this->consommationInfo = $consommationInfo;

        return $this;
    }

}
