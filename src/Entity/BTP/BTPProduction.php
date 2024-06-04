<?php

namespace App\Entity\BTP;

use App\Entity\Article;
use App\Entity\ProductionForm;
use App\Entity\Valromex\ValromexSaisieProduction;
use App\Repository\BTP\BTPProductionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BTPProductionRepository::class)]
class BTPProduction extends ProductionForm
{
    #[ORM\OneToOne(inversedBy: 'bTPProduction', cascade: ['persist', 'remove'])]
    private ?ValromexSaisieProduction $SaisieProduction = null;

    #[ORM\ManyToOne(inversedBy: 'bTPProductions')]
    private ?Article $article = null;

    public function getSaisieProduction(): ?ValromexSaisieProduction
    {
        return $this->SaisieProduction;
    }

    public function setSaisieProduction(?ValromexSaisieProduction $SaisieProduction): static
    {
        $this->SaisieProduction = $SaisieProduction;

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
