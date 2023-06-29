<?php

 namespace App\DataFixtures;

 use App\Entity\Category;
 use Doctrine\Bundle\FixturesBundle\Fixture;
 use Doctrine\Persistence\ObjectManager;

 class CategoryFixtures extends Fixture 
 {
     public function load(ObjectManager $manager): void
     {
         $category = new Category;
         $category->setName('1-HC');
         $this->addReference('category_0', $category);
         $manager->persist($category);
         $manager->flush();

         $category1 = new Category;
         $category1->setName('2-C');
         $this->addReference('category_1', $category1);
         $manager->persist($category1);
         $manager->flush();

         $category2 = new Category;
         $category2->setName('3-B');
         $this->addReference('category_2', $category2);
         $manager->persist($category2);
         $manager->flush();

         $category3 = new Category;
         $category3->setName('4-A');
         $this->addReference('category_3', $category3);
         $manager->persist($category3);
         $manager->flush();

         $category4 = new Category;
         $category4->setName('5-premium');
         $this->addReference('category_4', $category4);

         $manager->persist($category4);
         $manager->flush();
     }
 }
