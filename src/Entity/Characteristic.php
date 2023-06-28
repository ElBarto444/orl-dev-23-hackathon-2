<?php

namespace App\Entity;

use App\Repository\CharacteristicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacteristicRepository::class)]
class Characteristic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reseau = null;

    #[ORM\Column]
    private ?int $Stockage = null;

    #[ORM\Column(length: 255)]
    private ?string $Ecran = null;

    #[ORM\Column(length: 255)]
    private ?string $RAM = null;

    #[ORM\OneToMany(mappedBy: 'Characteristic', targetEntity: Mobil::class)]
    private Collection $mobils;

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
        return $this->Stockage;
    }

    public function setStockage(int $Stockage): static
    {
        $this->Stockage = $Stockage;

        return $this;
    }

    public function getEcran(): ?string
    {
        return $this->Ecran;
    }

    public function setEcran(string $Ecran): static
    {
        $this->Ecran = $Ecran;

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
}
