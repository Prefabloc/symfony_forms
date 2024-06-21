<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MachineRepository::class)]
class Machine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Vous devez renseigner le nom d'une machine !")]
    #[Assert\Length(min: 1, minMessage: "Vous devez saisie au moins un caractère !")]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Choice(choices: [
        'engin',
        'vehicule'
    ]
    )]
    private ?string $type = null;


    /**
     * @var Collection<int, ConsommationEssence>
     */
    #[ORM\OneToMany(targetEntity: ConsommationEssence::class, mappedBy: 'machineID')]
    private Collection $consommationEssences;

    public function __construct()
    {
        $this->consommationEssences = new ArrayCollection();
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
     * @return Collection<int, ConsommationEssence>
     */
    public function getConsommationEssences(): Collection
    {
        return $this->consommationEssences;
    }

    public function addConsommationEssence(ConsommationEssence $consommationEssence): static
    {
        if (!$this->consommationEssences->contains($consommationEssence)) {
            $this->consommationEssences->add($consommationEssence);
            $consommationEssence->setMachine($this);
        }

        return $this;
    }

    public function removeConsommationEssence(ConsommationEssence $consommationEssence): static
    {
        if ($this->consommationEssences->removeElement($consommationEssence)) {
            // set the owning side to null (unless already changed)
            if ($consommationEssence->getMachine() === $this) {
                $consommationEssence->setMachine(null);
            }
        }

        return $this;
    }
}
