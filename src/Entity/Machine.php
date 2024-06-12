<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MachineRepository::class)]
class Machine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
//    #[Assert\Choice(choices: [
//        'engin',
//        'vehicule']
//    )]
//    #[Assert\Type(type: ['engin', 'vehicule'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

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
            $consommationEssence->setMachineID($this);
        }

        return $this;
    }

    public function removeConsommationEssence(ConsommationEssence $consommationEssence): static
    {
        if ($this->consommationEssences->removeElement($consommationEssence)) {
            // set the owning side to null (unless already changed)
            if ($consommationEssence->getMachineID() === $this) {
                $consommationEssence->setMachineID(null);
            }
        }

        return $this;
    }
}
