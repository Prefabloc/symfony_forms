<?php

namespace App\Entity\Prefabloc;

use App\Entity\Article;
use App\Entity\MotifDeclassement;
use App\Repository\Prefabloc\SaisieDeclassementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SaisieDeclassementRepository::class)]
class SaisieDeclassement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir une quantité entre 1 et 1000.", min: 0, max: 1000)]
    private ?string $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'saisieDeclassements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MotifDeclassement $motifDeclassement = null;

    #[ORM\ManyToOne(inversedBy: 'saisieDeclassements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

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
