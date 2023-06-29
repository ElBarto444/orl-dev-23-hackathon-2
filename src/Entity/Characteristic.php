<?php

namespace App\Entity;

use App\Repository\CharacteristicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacteristicRepository::class)]
class Characteristic
{
    public const PHONE_CONDITION = [
        'DEEE',
        'REPARABLE',
        'BLOQUE',
        'RECONDITIONABLE',
        'RECONDITIONNE'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reseau = null;

    #[ORM\Column]
    private ?int $stockage = null;

    #[ORM\Column(length: 255)]
    private ?string $ecran = null;

    #[ORM\Column(length: 255)]
    private ?string $RAM = null;

    #[ORM\OneToMany(mappedBy: 'characteristic', targetEntity: Mobil::class)]
    private Collection $mobils;

    #[ORM\Column(length: 255)]
    private ?string $phoneCondition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    public function __construct()
    {
        $this->mobils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReseau(): ?string
    {
        return $this->reseau;
    }

    public function setReseau(string $reseau): static
    {
        $this->reseau = $reseau;

        return $this;
    }

    public function getStockage(): ?int
    {
        return $this->stockage;
    }

    public function setStockage(int $stockage): static
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getEcran(): ?string
    {
        return $this->ecran;
    }

    public function setEcran(string $ecran): static
    {
        $this->ecran = $ecran;

        return $this;
    }

    public function getRAM(): ?string
    {
        return $this->RAM;
    }

    public function setRAM(string $RAM): static
    {
        $this->RAM = $RAM;

        return $this;
    }

    /**
     * @return Collection<int, Mobil>
     */
    public function getMobils(): Collection
    {
        return $this->mobils;
    }

    public function addMobil(Mobil $mobil): static
    {
        if (!$this->mobils->contains($mobil)) {
            $this->mobils->add($mobil);
            $mobil->setCharacteristic($this);
        }

        return $this;
    }

    public function removeMobil(Mobil $mobil): static
    {
        if ($this->mobils->removeElement($mobil)) {
            // set the owning side to null (unless already changed)
            if ($mobil->getCharacteristic() === $this) {
                $mobil->setCharacteristic(null);
            }
        }

        return $this;
    }

    public function getPhoneCondition(): ?string
    {
        return $this->phoneCondition;
    }

    public function setPhoneCondition(string $phoneCondition): static
    {
        $this->phoneCondition = $phoneCondition;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }
}
