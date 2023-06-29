<?php

namespace App\Service;

use App\Entity\Mobil;
use App\Entity\Calculator;
use App\Form\MobilType;
use App\Repository\MobilRepository;

class CalculatorService
{
    public function calculate(string $dataRAM, string $dataStorage): string
    {
        $mobil = new Mobil();
        $calculator = new Calculator();

        foreach (Calculator::MEMORY_VAL as $keyRam => $valueRam) {
            if ($dataRAM === $keyRam) {
                $ramVal = $valueRam;
            }
        }

        //loop in the storage_val const to find matching value on entered storage parameter
        foreach (Calculator::STORAGE_VAL as $keyStorage => $valueStorage) {
            if ($dataStorage === $keyStorage) {
                $storageVal = $valueStorage;
            }
        }

        //get data from new mobile form and add the two values
        $sum = $storageVal + $ramVal;
        //deduce percentage from the resulting score
        $reduce = $sum * $calculator->getPricingPercentage();
        $result = $sum - $reduce;

        //set the phone's category in a switch statement
        switch ($result) {
            case ($result <= 60):
                $mobil->setCategoryName('1 - HC');
                break;
            case ($result <= 90):
                $mobil->setCategoryName('2 - C');
                break;
            case ($result <= 150):
                $mobil->setCategoryName('3 - B');
                break;
            case ($result <= 250):
                $mobil->setCategoryName('4 - A');
                break;
            case ($result > 250):
                $mobil->setCategoryName('5 - Premium');
                break;
        }
        return $mobil->getCategoryName();
    }
}
