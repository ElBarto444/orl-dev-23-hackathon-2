<?php

namespace App\DataFixtures;

use App\Entity\Mobil;
use App\DataFixtures\CategoryFixtures;
use App\DataFixtures\CharacteristicFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MobilFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $mobil = new Mobil;
        $mobil->setMarque('Samsung');
        $mobil->setModele('Galaxy S3');
        $this->addReference('mobil_0', $mobil);
        $mobil->setCharacteristic($this->getReference('characteristic_0'));
        $mobil->setCategory($this->getReference('category_0'));
        $manager->persist($mobil);
        $manager->flush();

        $mobil1 = new Mobil;
        $mobil1->setMarque('Apple');
        $mobil1->setModele('iPhone13');
        $this->addReference('mobil_1', $mobil1);
        $mobil1->setCharacteristic($this->getReference('characteristic_1'));
        $mobil->setCategory($this->getReference('category_1'));
        $manager->persist($mobil1);
        $manager->flush();

        $mobil2 = new Mobil;
        $mobil2->setMarque('Nokia');
        $mobil2->setModele('G22');
        $this->addReference('mobil_2', $mobil2);
        $mobil2->setCharacteristic($this->getReference('characteristic_2'));
        $mobil->setCategory($this->getReference('category_2'));
        $manager->persist($mobil2);
        $manager->flush();

        $mobil3 = new Mobil;
        $mobil3->setMarque('Huawei');
        $mobil3->setModele('P30');
        $this->addReference('mobil_3', $mobil3);
        $mobil3->setCharacteristic($this->getReference('characteristic_3'));
        $mobil->setCategory($this->getReference('category_3'));
        $manager->persist($mobil3);
        $manager->flush();

        $mobil4 = new Mobil;
        $mobil4->setMarque('Sony');
        $mobil4->setModele('Xperia 10 IV');
        $this->addReference('mobil_4', $mobil4);
        $mobil4->setCharacteristic($this->getReference('characteristic_4'));
        $mobil->setCategory($this->getReference('category_4'));
        $manager->persist($mobil4);
        $manager->flush();

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            CharacteristicFixtures::class,
            CategoryFixtures::class,

        ];
    }
}
