<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FaqFixtures extends Fixture
{

    public const FAQ = [
        [
            'questions' => 'Ou pouvons-nous vous trouvez ?',
            'reponse' => 'Nous sommes présent partout en France, notre page d\'accueil comprend un
            bouton "Nos lieux" ou vous pouvez tout trouver !',
        ],
        [
            'questions' => 'Comment sont récoltés les appareils numériques ?',
            'reponse' => 'Nos appareils numériques sont uniquement récoltés sous la base du don.',
        ],
        [
            'questions' => 'Comment pouvons nous devenir bénévole ?',
            'reponse' => 'Tout simplement en demandant à une association "Emmaus", celle qui vous intéresse.',
        ],
        [
            'questions' => 'Les bénévoles ont-ils des avantages ?',
            'reponse' => 'Oui, ils ont un accès à des jeux leurs permettant de gagner des remises sur des produits, des formations...',
        ],
        [
            'questions' => 'Les bénévoles sont-ils payés ?',
            'reponse' => 'Non, tout cela comme indiquer, ce base sur le volontariat',
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

