<?php

namespace App\Entity\Agregat;

use App\Entity\Article;
use App\Repository\Agregat\ConcassageSaisieDebitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ConcassageSaisieDebitRepository::class)]
class ConcassageSaisieDebit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir un poids entre 1 et 1000 tonnes", min: 0, max: 1000)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'concassageSaisieDebits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

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
