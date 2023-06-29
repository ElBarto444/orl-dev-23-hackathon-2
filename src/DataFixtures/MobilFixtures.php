<?php

namespace App\DataFixtures;

use App\Entity\Mobil;
use App\DataFixtures\CategoryFixtures;
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
        $mobil->setPoster('url(images/placeholdermobil.jpg)');
        $mobil->setReseau('4G');
        $mobil->setStockage('64');
        $mobil->setEcran('6P');
        $mobil->setRAM('2GO');
        
        $mobil->setCategory($this->getReference('category_0'));
        $manager->persist($mobil);
        $manager->flush();

        $mobil1 = new Mobil;
        $mobil1->setMarque('Apple');
        $mobil1->setModele('iPhone13');
        $this->addReference('mobil_1', $mobil1);
        $mobil1->setPoster(1);
        $mobil1->setReseau('5G');
        $mobil1->setStockage('32');
        $mobil1->setEcran('5P');
        $mobil1->setRAM('1GO');
        $mobil->setCategory($this->getReference('category_1'));
        $manager->persist($mobil1);
        $manager->flush();

        $mobil2 = new Mobil;
        $mobil2->setMarque('Nokia');
        $mobil2->setModele('G22');
        $this->addReference('mobil_2', $mobil2);
        $mobil2->setPoster(2);
        $mobil2->setReseau('4G');
        $mobil2->setStockage('64');
        $mobil2->setEcran('4P');
        $mobil2->setRAM('2GO');
        $mobil->setCategory($this->getReference('category_2'));
        $manager->persist($mobil2);
        $manager->flush();

        $mobil3 = new Mobil;
        $mobil3->setMarque('Huawei');
        $mobil3->setModele('P30');
        $this->addReference('mobil_3', $mobil3);
        $mobil3->setPoster(3);
        $mobil3->setReseau('4G');
        $mobil3->setStockage('64');
        $mobil3->setEcran('5P');
        $mobil3->setRAM('1GO');
        $mobil->setCategory($this->getReference('category_3'));
        $manager->persist($mobil3);
        $manager->flush();

        $mobil4 = new Mobil;
        $mobil4->setMarque('Sony');
        $mobil4->setModele('Xperia 10 IV');
        $this->addReference('mobil_4', $mobil4);
        $mobil4->setPoster(4);
        $mobil4->setReseau('4G');
        $mobil4->setStockage('64');
        $mobil4->setEcran('6P');
        $mobil4->setRAM('2GO');
        $mobil->setCategory($this->getReference('category_4'));
        $manager->persist($mobil4);
        $manager->flush();

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,

        ];
    }
}
