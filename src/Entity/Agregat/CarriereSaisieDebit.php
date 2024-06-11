<?php

namespace App\Entity\Agregat;

use App\Entity\Article;
use App\Repository\Agregat\CarriereSaisieDebitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarriereSaisieDebitRepository::class)]
class CarriereSaisieDebit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'carriereSaisieDebits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir un poids entre 1 et 1000 tonnes", min: 0, max: 1000)]
    private ?int $quantite = null;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }



}
