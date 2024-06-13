<?php

namespace App\Entity;

use App\Entity\Prefabloc\ReparationPalette;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $label = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank()]
    private ?Societe $societe = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?bool $canBeProduced = null;

    #[ORM\Column]
    private ?float $stock = null;

    /**
     * @var Collection<int, HistoriqueActionsArticle>
     */
    #[ORM\OneToMany(targetEntity: HistoriqueActionsArticle::class, mappedBy: 'article')]
    private Collection $historiqueActionsArticles;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeArticle = null;

    /**
     * @var Collection<int, ReparationPalette>
     */
    #[ORM\OneToMany(targetEntity: ReparationPalette::class, mappedBy: 'typePalette')]
    private Collection $reparationPalettes;


    public function __construct()
    {
        $this->historiqueActionsArticles = new ArrayCollection();
        $this->reparationPalettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    public function isCanBeProduced(): ?bool
    {
        return $this->canBeProduced;
    }

    public function setCanBeProduced(bool $canBeProduced): static
    {
        $this->canBeProduced = $canBeProduced;

        return $this;
    }

    public function getStock(): ?float
    {
        return $this->stock;
    }

    public function setStock(float $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, HistoriqueActionsArticle>
     */
    public function getHistoriqueActionsArticles(): Collection
    {
        return $this->historiqueActionsArticles;
    }

    public function addHistoriqueActionsArticle(HistoriqueActionsArticle $historiqueActionsArticle): static
    {
        if (!$this->historiqueActionsArticles->contains($historiqueActionsArticle)) {
            $this->historiqueActionsArticles->add($historiqueActionsArticle);
            $historiqueActionsArticle->setArticle($this);
        }

        return $this;
    }

    public function removeHistoriqueActionsArticle(HistoriqueActionsArticle $historiqueActionsArticle): static
    {
        if ($this->historiqueActionsArticles->removeElement($historiqueActionsArticle)) {
            // set the owning side to null (unless already changed)
            if ($historiqueActionsArticle->getArticle() === $this) {
                $historiqueActionsArticle->setArticle(null);
            }
        }

        return $this;
    }

    public function getTypeArticle(): ?string
    {
        return $this->typeArticle;
    }

    public function setTypeArticle(?string $typeArticle): static
    {
        $this->typeArticle = $typeArticle;

        return $this;
    }

    /**
     * @return Collection<int, ReparationPalette>
     */
    public function getReparationPalettes(): Collection
    {
        return $this->reparationPalettes;
    }

    public function addReparationPalette(ReparationPalette $reparationPalette): static
    {
        if (!$this->reparationPalettes->contains($reparationPalette)) {
            $this->reparationPalettes->add($reparationPalette);
            $reparationPalette->setTypePalette($this);
        }

        return $this;
    }

    public function removeReparationPalette(ReparationPalette $reparationPalette): static
    {
        if ($this->reparationPalettes->removeElement($reparationPalette)) {
            // set the owning side to null (unless already changed)
            if ($reparationPalette->getTypePalette() === $this) {
                $reparationPalette->setTypePalette(null);
            }
        }

        return $this;
    }
}
