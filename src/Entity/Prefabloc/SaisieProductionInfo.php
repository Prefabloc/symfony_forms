<?php

namespace App\Entity\Prefabloc;

use App\Repository\Prefabloc\SaisieProductionInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisieProductionInfoRepository::class)]
class SaisieProductionInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $nbGachet = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\OneToOne(inversedBy: 'saisieProductionInfo', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?PrefablocProduction $production = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $firstTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lastTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timeStop = null;

    #[ORM\OneToOne(mappedBy: 'consommationInfo', cascade: ['persist', 'remove'])]
    private ?PrefablocProduction $prefablocProduction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGachet(): ?float
    {
        return $this->nbGachet;
    }

    public function setNbGachet(float $nbGachet): static
    {
        $this->nbGachet = $nbGachet;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getProduction(): ?PrefablocProduction
    {
        return $this->production;
    }

    public function setProduction(PrefablocProduction $production): static
    {
        $this->production = $production;

        return $this;
    }

    public function getFirstTime(): ?\DateTimeInterface
    {
        return $this->firstTime;
    }

    public function setFirstTime(\DateTimeInterface $firstTime): static
    {
        $this->firstTime = $firstTime;

        return $this;
    }

    public function getLastTime(): ?\DateTimeInterface
    {
        return $this->lastTime;
    }

    public function setLastTime(\DateTimeInterface $lastTime): static
    {
        $this->lastTime = $lastTime;

        return $this;
    }

    public function getTimeStop(): ?\DateTimeInterface
    {
        return $this->timeStop;
    }

    public function setTimeStop(\DateTimeInterface $timeStop): static
    {
        $this->timeStop = $timeStop;

        return $this;
    }

    public function getPrefablocProduction(): ?PrefablocProduction
    {
        return $this->prefablocProduction;
    }

    public function setPrefablocProduction(?PrefablocProduction $prefablocProduction): static
    {
        // unset the owning side of the relation if necessary
        if ($prefablocProduction === null && $this->prefablocProduction !== null) {
            $this->prefablocProduction->setConsommationInfo(null);
        }

        // set the owning side of the relation if necessary
        if ($prefablocProduction !== null && $prefablocProduction->getConsommationInfo() !== $this) {
            $prefablocProduction->setConsommationInfo($this);
        }

        $this->prefablocProduction = $prefablocProduction;

        return $this;
    }
}
