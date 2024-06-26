<?php

namespace App\Entity;

use App\Repository\CompteurDeauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteurDeauRepository::class)]
class CompteurDeau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, ConsommationEau>
     */
    #[ORM\OneToMany(targetEntity: ConsommationEau::class, mappedBy: 'compteur')]
    private Collection $consommationEaus;

    public function __construct()
    {
        $this->consommationEaus = new ArrayCollection();
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
     * @return Collection<int, ConsommationEau>
     */
    public function getConsommationEaus(): Collection
    {
        return $this->consommationEaus;
    }

    public function addConsommationEau(ConsommationEau $consommationEau): static
    {
        if (!$this->consommationEaus->contains($consommationEau)) {
            $this->consommationEaus->add($consommationEau);
            $consommationEau->setCompteur($this);
        }

        return $this;
    }

    public function removeConsommationEau(ConsommationEau $consommationEau): static
    {
        if ($this->consommationEaus->removeElement($consommationEau)) {
            // set the owning side to null (unless already changed)
            if ($consommationEau->getCompteur() === $this) {
                $consommationEau->setCompteur(null);
            }
        }

        return $this;
    }
}
