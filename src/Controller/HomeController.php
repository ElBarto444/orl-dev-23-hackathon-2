<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Calculator;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        //$calculator = new Calculator();
        //$calculator->calculate(54, 66);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            //'calculator' => $calculator,
        ]);
    }
}
