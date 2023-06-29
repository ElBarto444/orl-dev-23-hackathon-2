<?php

namespace App\Entity;

use App\Repository\CalculatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculatorRepository::class)]
class Calculator extends Mobil
{
    public const MEMORY_VAL = [
        '1Go' => 30, 
        '2Go' => 40, 
        '3Go' => 54, 
        '4Go' => 74, 
        '6Go' => 100, 
        '8Go' => 134, 
        '12Go' => 181, 
        '16Go' => 245
    ];

    public const STORAGE_VAL = [
        '16Go' => 31, 
        '32Go' => 45, 
        '64Go' => 66, 
        '128Go' => 96, 
        '256Go' => 139, 
        '512Go' => 201, 
        '1024Go' => 292
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $memoryVal = null;

    #[ORM\Column(nullable: true)]
    private ?int $storageValue = null;

    #[ORM\Column(nullable: true)]
    private ?int $pricingPercentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMemoryVal(): ?int
    {
        return $this->memoryVal;
    }

    public function setMemoryVal(?int $memoryVal): static
    {
        $this->memoryVal = $memoryVal;

        return $this;
    }

    public function getStorageValue(): ?int
    {
        return $this->storageValue;
    }

    public function setStorageValue(?int $storageValue): static
    {
        $this->storageValue = $storageValue;

        return $this;
    }

    public function getPricingPercentage(): ?int
    {
        return $this->pricingPercentage;
    }

    public function setPricingPercentage(?string $condition): static
    {
        foreach (self::PHONE_CONDITION as $condition) {
            if ($condition === 'DEEE') {
                $pricingPercentage = (-100 / 100);
            }
            if ($condition === 'REPARABLE') {
                $pricingPercentage = (-50 / 100);
            }
            if ($condition === 'BLOQUE') {
                $pricingPercentage = (-10 / 100);
            }
            if ($condition === 'RECONDITIONABLE') {
                $pricingPercentage = (-5 / 100);
            }
            if ($condition === 'RECONDITIONNE') {
                $pricingPercentage = 0;
            }
        }
        $this->pricingPercentage = $pricingPercentage;

        return $this;
    }
}
