<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WheelController extends AbstractController
{
    #[Route('/wheel', name: 'app_roue')]
    public function index(): Response
    {
        return $this->render('wheel/index.html.twig');
    }
}