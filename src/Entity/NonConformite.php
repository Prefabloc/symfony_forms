<?php

namespace App\Entity;

use App\Repository\NonConformiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NonConformiteRepository::class)]
class NonConformite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'nonConformites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[ORM\Column]
    private ?float $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $typeDoc = null;

    #[ORM\Column(length: 255)]
    private ?string $numDoc = null;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\OneToMany(targetEntity: Signalement::class, mappedBy: 'nonConformite')]
    private Collection $commentaire;

    #[ORM\Column(length: 255)]
    private ?string $photos = null;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTypeDoc(): ?string
    {
        return $this->typeDoc;
    }

    public function setTypeDoc(string $typeDoc): static
    {
        $this->typeDoc = $typeDoc;

        return $this;
    }

    public function getNumDoc(): ?string
    {
        return $this->numDoc;
    }

    public function setNumDoc(string $numDoc): static
    {
        $this->numDoc = $numDoc;

        return $this;
    }

    /**
     * @return Collection<int, Signalement>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Signalement $commentaire): static
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire->add($commentaire);
            $commentaire->setNonConformite($this);
        }

        return $this;
    }

    public function removeCommentaire(Signalement $commentaire): static
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getNonConformite() === $this) {
                $commentaire->setNonConformite(null);
            }
        }

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(?string $photos): static
    {
        $this->photos = $photos;

        return $this;
    }
}
