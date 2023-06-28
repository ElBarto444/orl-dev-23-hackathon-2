<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Mobil::class)]
    private Collection $mobils;

    public function __construct()
    {
        $this->mobils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $mobil->setCategory($this);
        }

        return $this;
    }

    public function removeMobil(Mobil $mobil): static
    {
        if ($this->mobils->removeElement($mobil)) {
            // set the owning side to null (unless already changed)
            if ($mobil->getCategory() === $this) {
                $mobil->setCategory(null);
            }
        }

        return $this;
    }
}
