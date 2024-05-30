<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PointageRepository::class)]
class Pointage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pointages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Site $Site = null;

    #[ORM\ManyToOne(inversedBy: 'pointages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employe = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrivedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThan(propertyPath: 'arrivedAt' , message: "La date de départ doit être postérieure à la date d'arrivée !")]

    private ?\DateTimeInterface $departedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite(): ?Site
    {
        return $this->Site;
    }

    public function setSite(?Site $Site): static
    {
        $this->Site = $Site;

        return $this;
    }

    public function getEmploye(): ?User
    {
        return $this->employe;
    }

    public function setEmploye(?User $employe): static
    {
        $this->employe = $employe;

        return $this;
    }

    public function getArrivedAt(): ?\DateTimeInterface
    {
        return $this->arrivedAt;
    }

    public function setArrivedAt(\DateTimeInterface $arrivedAt): static
    {
        $this->arrivedAt = $arrivedAt;

        return $this;
    }

    public function getDepartedAt(): ?\DateTimeInterface
    {
        return $this->departedAt;
    }

    public function setDepartedAt(?\DateTimeInterface $departedAt): static
    {
        $this->departedAt = $departedAt;

        return $this;
    }

    public function __toString()
    {
        return sprintf('User ' . $this->getEmploye() . ' Site ' . $this->getSite() . ' Arrivee ' . $this->getArrivedAt()->format('Y-m-d H:i:s') . ' Depart ' . $this->getDepartedAt()->format('Y-m-d H:i:s') );
    }
}
