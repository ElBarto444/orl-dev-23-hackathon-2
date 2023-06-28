<?php

namespace App\DataFixtures;

use App\Entity\Characteristic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CharacteristicFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $characteristic = new Characteristic;
        $characteristic->setReseau('4G');
        $characteristic->setStockage('64');
        $characteristic->setEcran('6P');
        $characteristic->setRAM('2GO');
        $this->addReference('characteristic_0', $characteristic);
        $manager->persist($characteristic);
         $manager->flush();

        $characteristic1 = new Characteristic;
        $characteristic1->setReseau('5G');
        $characteristic1->setStockage('32');
        $characteristic1->setEcran('5P');
        $characteristic1->setRAM('1GO');
        $this->addReference('characteristic_1', $characteristic1);
        $manager->persist($characteristic1);
        $manager->flush();

        $characteristic2 = new Characteristic;
        $characteristic2->setReseau('4G');
        $characteristic2->setStockage('64');
        $characteristic2->setEcran('4P');
        $characteristic2->setRAM('2GO');
        $this->addReference('characteristic_2', $characteristic2);
        $manager->persist($characteristic2);
        $manager->flush();

        $characteristic3 = new Characteristic;
        $characteristic3->setReseau('4G');
        $characteristic3->setStockage('64');
        $characteristic3->setEcran('5P');
        $characteristic3->setRAM('1GO');
        $this->addReference('characteristic_3', $characteristic3);
        $manager->persist($characteristic3);
        $manager->flush();

        $characteristic4 = new Characteristic;
        $characteristic4->setReseau('4G');
        $characteristic4->setStockage('64');
        $characteristic4->setEcran('6P');
        $characteristic4->setRAM('2GO');
        $this->addReference('characteristic_4', $characteristic4);
        $manager->persist($characteristic4);
        $manager->flush();

    }
}
