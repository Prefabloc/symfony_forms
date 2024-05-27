<?php

namespace App\Entity;

use App\Repository\HistoriqueActionsArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueActionsArticleRepository::class)]
class HistoriqueActionsArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueActionsArticles')]
    private ?Article $article = null;

    #[ORM\Column]
    private ?float $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueActionsArticles')]
    private ?User $personneModifiant = null;

    public function getId(): ?int
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

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPersonneModifiant(): ?User
    {
        return $this->personneModifiant;
    }

    public function setPersonneModifiant(?User $personneModifiant): static
    {
        $this->personneModifiant = $personneModifiant;

        return $this;
    }
}
