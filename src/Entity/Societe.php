<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, ProductionArticle>
     */
    #[ORM\OneToMany(targetEntity: ProductionArticle::class, mappedBy: 'societe')]
    private Collection $productionArticles;

    public function __construct()
    {
        $this->productionArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, ProductionArticle>
     */
    public function getProductionArticles(): Collection
    {
        return $this->productionArticles;
    }

    public function addProductionArticle(ProductionArticle $productionArticle): static
    {
        if (!$this->productionArticles->contains($productionArticle)) {
            $this->productionArticles->add($productionArticle);
            $productionArticle->setSociete($this);
        }

        return $this;
    }

    public function removeProductionArticle(ProductionArticle $productionArticle): static
    {
        if ($this->productionArticles->removeElement($productionArticle)) {
            // set the owning side to null (unless already changed)
            if ($productionArticle->getSociete() === $this) {
                $productionArticle->setSociete(null);
            }
        }

        return $this;
    }
}
