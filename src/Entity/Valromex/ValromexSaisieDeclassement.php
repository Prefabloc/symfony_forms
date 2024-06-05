<?php

namespace App\Entity\Valromex;

use App\Entity\Article;
use App\Entity\MotifDeclassement;
use App\Repository\Valromex\ValromexSaisieDeclassementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ValromexSaisieDeclassementRepository::class)]
class ValromexSaisieDeclassement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir une quantité entre 0 et 10000.", min: 0, max: 10000)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'valromexSaisieDeclassements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'valromexSaisieDeclassements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MotifDeclassement $motifDeclassement = null;


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

    public function getMotifDeclassement(): ?MotifDeclassement
    {
        return $this->motifDeclassement;
    }

    public function setMotifDeclassement(?MotifDeclassement $motifDeclassement): static
    {
        $this->motifDeclassement = $motifDeclassement;

        return $this;
    }


}
