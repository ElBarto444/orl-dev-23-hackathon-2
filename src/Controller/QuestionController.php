<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FaqRepository;

class QuestionController extends AbstractController
{
    #[Route('/question', name: 'app_question')]
    public function index(FaqRepository $faqRepository): Response
    {
        return $this->render('question/index.html.twig', [
            'faqs' => $faqRepository->findAll(),
        ]);
    }
}