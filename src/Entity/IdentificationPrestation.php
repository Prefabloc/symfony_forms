<?php

namespace App\Entity;

use App\Repository\IdentificationPrestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: IdentificationPrestationRepository::class)]
class IdentificationPrestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Vous devez renseigner une société !')]
    #[Assert\Length(min: 1, max: 50, minMessage: "Vous devez entrer au moins un caractère !", maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $societe = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un nom et un prénom !')]
    #[Assert\Regex(pattern: "/^[\p{L}\s'-]+$/u", message: "Vous ne pouvez pas avoir de chiffres dans votre nom / prénom !")]
    #[Assert\Length(min: 1, max: 50, minMessage: "Vous devez entrer au moins un caractère !", maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $nomPrenom = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Vous devez renseigner une prestation !')]
    #[Assert\Length(min: 1, max: 50, minMessage: "Vous devez entrer au moins un caractère !", maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $prestation = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un commanditaire !')]
    #[Assert\Length(min: 1, max: 50, minMessage: "Vous devez entrer au moins un caractère !", maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $commanditaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: "Vous devez renseigner une heure d'arrivée !")]
    private ?\DateTimeInterface $heureArrivee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThan(propertyPath: 'heureArrivee', message: "Le moment du départ doit être postérieur à celui de l'arrivée !")]
    private ?\DateTimeInterface $heureDepart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $signature = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoBonPrestation = null;

    #[ORM\ManyToOne(inversedBy: 'identificationPrestations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Site $site = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    public function setNomPrenom(string $nomPrenom): static
    {
        $this->nomPrenom = $nomPrenom;

        return $this;
    }

    public function getPrestation(): ?string
    {
        return $this->prestation;
    }

    public function setPrestation(string $prestation): static
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getCommanditaire(): ?string
    {
        return $this->commanditaire;
    }

    public function setCommanditaire(string $commanditaire): static
    {
        $this->commanditaire = $commanditaire;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heureArrivee): static
    {
        $this->heureArrivee = $heureArrivee;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(?\DateTimeInterface $heureDepart): static
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(?string $signature): static
    {
        $this->signature = $signature;

        return $this;
    }

    public function getPhotoBonPrestation(): ?string
    {
        return $this->photoBonPrestation;
    }

    public function setPhotoBonPrestation(?string $photoBonPrestation): static
    {
        $this->photoBonPrestation = $photoBonPrestation;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): static
    {
        $this->site = $site;

        return $this;
    }
}
