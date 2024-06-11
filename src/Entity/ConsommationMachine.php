<?php

namespace App\Entity;

use App\Repository\ConsommationMachineRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsommationMachineRepository::class)]
class ConsommationMachine
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

    #[ORM\Column(nullable: true)]
    private ?float $qteEssence = null;

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

    public function getQteEssence(): ?float
    {
        return $this->qteEssence;
    }

    public function setQteEssence(?float $qteEssence): static
    {
        $this->qteEssence = $qteEssence;

        return $this;
    }
}
