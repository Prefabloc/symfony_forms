<?php

namespace App\Entity\Valromex;

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

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un article !')]
    #[Assert\Length(min: 1, max: 50 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 51 caractères !")]
    private ?string $article = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un motif de déclassement !')]
    #[Assert\Length(min: 10, max: 200 , minMessage: "Vous devez entrer au moins 10 caractères !" , maxMessage: "Vous devez entrer moins de 201 caractères !")]

    private ?string $motifDeclassement = null;

    #[ORM\Column]
    #[Assert\Range(notInRangeMessage: "Vous devez choisir une quantité entre 0 et 10000.", min: 0, max: 10000)]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getMotifDeclassement(): ?string
    {
        return $this->motifDeclassement;
    }

    public function setMotifDeclassement(string $motifDeclassement): static
    {
        $this->motifDeclassement = $motifDeclassement;

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
