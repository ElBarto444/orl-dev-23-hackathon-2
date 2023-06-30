<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FaqFixtures extends Fixture
{

    public const FAQ = [
        [
            'questions' => 'Où pouvons-nous vous trouver ?',
            'reponse' => 'Nous sommes présent partout en France, notre page d\'accueil comprend un
            bouton "Nos lieux" ou vous pouvez tout trouver !',
        ],
        [
            'questions' => 'Comment sont récoltés les appareils numériques ?',
            'reponse' => 'Nos appareils numériques sont uniquement récoltés sur la base du don.',
        ],
        [
            'questions' => 'Comment pouvons-nous devenir bénévole ?',
            'reponse' => 'Tout simplement en demandant à une association "Emmaüs", celle de votre choix.',
        ],
        [
            'questions' => 'Les bénévoles ont-ils des avantages ?',
            'reponse' => 'Oui, ils ont un accès à des jeux leur permettant de gagner des remises sur des produits, des formations...',
        ],
        [
            'questions' => 'Les bénévoles sont-ils payés ?',
            'reponse' => 'Non, tout comme indiqué, cela se base uniquement sur le volontariat.',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

    foreach (self::FAQ as $faqs) {
        $faq = new FAQ();
        $faq->setQuestions($faqs['questions']);
        $faq->setReponse($faqs['reponse']);
        $manager->persist($faq);
    }

    $manager->flush();
}
}

