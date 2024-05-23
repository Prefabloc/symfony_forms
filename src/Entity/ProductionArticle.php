<?php

namespace App\Entity;

use App\Entity\BTP\BTPProduction;
use App\Entity\Prefabloc\PrefablocProduction;
use App\Repository\ProductionArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionArticleRepository::class)]
class ProductionArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToOne(inversedBy: 'productionArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    #[ORM\Column(nullable: true)]
    private ?bool $canBeProduced = null;

    #[ORM\Column]
    private ?float $stock = null;

    /**
     * @var Collection<int, HistoriqueActionsArticle>
     */
    #[ORM\OneToMany(targetEntity: HistoriqueActionsArticle::class, mappedBy: 'article')]
    private Collection $historiqueActionsArticles;

    /**
     * @var Collection<int, PrefablocProduction>
     */
    #[ORM\OneToMany(targetEntity: PrefablocProduction::class, mappedBy: 'article')]
    private Collection $prefablocProductions;

    /**
     * @var Collection<int, BTPProduction>
     */
    #[ORM\OneToMany(targetEntity: BTPProduction::class, mappedBy: 'article')]
    private Collection $bTPProductions;

    public function __construct()
    {
        $this->historiqueActionsArticles = new ArrayCollection();
        $this->prefablocProductions = new ArrayCollection();
        $this->bTPProductions = new ArrayCollection();
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

    public function setCanBeProduced(?bool $canBeProduced): static
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

    /**
     * @return Collection<int, PrefablocProduction>
     */
    public function getPrefablocProductions(): Collection
    {
        return $this->prefablocProductions;
    }

    public function addPrefablocProduction(PrefablocProduction $prefablocProduction): static
    {
        if (!$this->prefablocProductions->contains($prefablocProduction)) {
            $this->prefablocProductions->add($prefablocProduction);
            $prefablocProduction->setArticle($this);
        }

        return $this;
    }

    public function removePrefablocProduction(PrefablocProduction $prefablocProduction): static
    {
        if ($this->prefablocProductions->removeElement($prefablocProduction)) {
            // set the owning side to null (unless already changed)
            if ($prefablocProduction->getArticle() === $this) {
                $prefablocProduction->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BTPProduction>
     */
    public function getBTPProductions(): Collection
    {
        return $this->bTPProductions;
    }

    public function addBTPProduction(BTPProduction $bTPProduction): static
    {
        if (!$this->bTPProductions->contains($bTPProduction)) {
            $this->bTPProductions->add($bTPProduction);
            $bTPProduction->setArticle($this);
        }

        return $this;
    }

    public function removeBTPProduction(BTPProduction $bTPProduction): static
    {
        if ($this->bTPProductions->removeElement($bTPProduction)) {
            // set the owning side to null (unless already changed)
            if ($bTPProduction->getArticle() === $this) {
                $bTPProduction->setArticle(null);
            }
        }

        return $this;
    }
}
