<?php

namespace App\Entity;

use App\Repository\CalculatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculatorRepository::class)]
class Calculator extends Characteristic
{
    public const MEMORY_VAL = [
        1 => 30, 
        2 => 40, 
        3 => 54, 
        4 => 74, 
        6 => 100, 
        8 => 134, 
        12 => 181, 
        16 => 245
    ];

    public const STORAGE_VAL = [
        16 => 31, 
        32 => 45, 
        64 => 66, 
        128 => 96, 
        256 => 139, 
        512 => 201, 
        1024 => 292
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

    public function calculate(int $memoryVal, int $storageValue): void
    {
        //loop in the memory_val const to find matching value on entered RAM parameter
        foreach (self::MEMORY_VAL as $key => $value) {
            if ($this->getRAM() === $key) {
                $memoryVal = $value;
            }
        }

        //loop in the storage_val const to find matching value on entered storage parameter
        foreach (self::STORAGE_VAL as $key => $value) {
            if ($this->getStockage() === strval($key)) {
                $storageValue = $value;
            }
        }

        //get data from new mobile form and add the two values
        $sum = $memoryVal + $storageValue;
        //deduce percentage from the resulting score
        $reduce = $sum * $this->pricingPercentage;
        $result = $sum - $reduce;

        //set the phone's category in a switch statement
        switch ($result) {
            case ($result <= 60):
                parent::setCategory('1 - HC');
                break;
            case ($result <= 90):
                parent::setCategory('2 - C');
                break;
            case ($result <= 150):
                parent::setCategory('3 - B');
                break;
            case ($result <= 250):
                parent::setCategory('4 - A');
                break;
            case ($result > 250):
                parent::setCategory('5 - Premium');
                break;
        }
    }

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
