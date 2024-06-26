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

    #[ORM\OneToOne(mappedBy: 'production', cascade: ['persist', 'remove'])]
    private ?SaisieProductionInfo $saisieProductionInfo = null;

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

    public function getSaisieProductionInfo(): ?SaisieProductionInfo
    {
        return $this->saisieProductionInfo;
    }

    public function setSaisieProductionInfo(SaisieProductionInfo $saisieProductionInfo): static
    {
        // set the owning side of the relation if necessary
        if ($saisieProductionInfo->getProduction() !== $this) {
            $saisieProductionInfo->setProduction($this);
        }

        $this->saisieProductionInfo = $saisieProductionInfo;

        return $this;
    }

}
