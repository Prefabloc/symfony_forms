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
    #[Assert\Length(min: 1, max: 50 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $societe = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un nom et un prénom !')]
    #[Assert\Regex(pattern: "/^[\p{L}\s'-]+$/u" , message: "Vous ne pouvez pas avoir de chiffres dans votre nom / prénom !")]
    #[Assert\Length(min: 1, max: 50 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $nomPrenom = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Vous devez renseigner une prestation !')]
    #[Assert\Length(min: 1, max: 50 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $prestation = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Vous devez renseigner un commanditaire !')]
    #[Assert\Length(min: 1, max: 50 , minMessage: "Vous devez entrer au moins un caractère !" , maxMessage: "Vous devez entrer moins de 51 caractères !")]

    private ?string $commanditaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: "Vous devez renseigner une heure d'arrivée !")]
    private ?\DateTimeInterface $heureArrivee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\GreaterThan(propertyPath: 'heureArrivee' , message: "La date de départ doit être postérieure à la date d'arrivée !")]
    private ?\DateTimeInterface $heureDepart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $signatureId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $signerId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdfSansSignature = null;

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

    public function getSignatureId(): ?string
    {
        return $this->signatureId;
    }

    public function setSignatureId(?string $signatureId): static
    {
        $this->signatureId = $signatureId;

        return $this;
    }

    public function getDocumentId(): ?string
    {
        return $this->documentId;
    }

    public function setDocumentId(?string $documentId): static
    {
        $this->documentId = $documentId;

        return $this;
    }

    public function getSignerId(): ?string
    {
        return $this->signerId;
    }

    public function setSignerId(?string $signerId): static
    {
        $this->signerId = $signerId;

        return $this;
    }

    public function getPdfSansSignature(): ?string
    {
        return $this->pdfSansSignature;
    }

    public function setPdfSansSignature(?string $pdfSansSignature): static
    {
        $this->pdfSansSignature = $pdfSansSignature;

        return $this;
    }
}
