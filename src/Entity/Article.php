<?php

namespace App\Entity;

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

    // #[ORM\Column]
    // #[Assert\NotBlank()]
    // private ?bool $canBeProduced = null;

    #[ORM\Column]
    private ?float $stock = null;

    /**
     * @var Collection<int, HistoriqueActionsArticle>
     */
    #[ORM\OneToMany(targetEntity: HistoriqueActionsArticle::class, mappedBy: 'article')]
    private Collection $historiqueActionsArticles;

    #[ORM\Column]
    private ?float $nbParPalette = null;

    #[ORM\Column(length: 255)]
    private ?string $abreviation = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, NonConformite>
     */
    #[ORM\OneToMany(targetEntity: NonConformite::class, mappedBy: 'article')]
    private Collection $nonConformites;


    public function __construct()
    {
        $this->historiqueActionsArticles = new ArrayCollection();
        $this->nonConformites = new ArrayCollection();
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

    // public function isCanBeProduced(): ?bool
    // {
    //     return $this->canBeProduced;
    // }

    // public function setCanBeProduced(bool $canBeProduced): static
    // {
    //     $this->canBeProduced = $canBeProduced;

    //     return $this;
    // }

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

    public function getNbrParPalette(): ?float
    {
        return $this->nbParPalette;
    }

    public function setNbrParPalette(float $nbParPalette): static
    {
        $this->nbParPalette = $nbParPalette;

        return $this;
    }

    public function getAbreviation(): ?string
    {
        return $this->abreviation;
    }

    public function setAbreviation(string $abreviation): static
    {
        $this->abreviation = $abreviation;

        return $this;
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

    /**
     * @return Collection<int, NonConformite>
     */
    public function getNonConformites(): Collection
    {
        return $this->nonConformites;
    }

    public function addNonConformite(NonConformite $nonConformite): static
    {
        if (!$this->nonConformites->contains($nonConformite)) {
            $this->nonConformites->add($nonConformite);
            $nonConformite->setArticle($this);
        }

        return $this;
    }

    public function removeNonConformite(NonConformite $nonConformite): static
    {
        if ($this->nonConformites->removeElement($nonConformite)) {
            // set the owning side to null (unless already changed)
            if ($nonConformite->getArticle() === $this) {
                $nonConformite->setArticle(null);
            }
        }

        return $this;
    }




}
