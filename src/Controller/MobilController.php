<?php

namespace App\Controller;

use App\Entity\Mobil;
use App\Form\MobilType;
use App\Repository\MobilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mobil')]
class MobilController extends AbstractController
{
    #[Route('/', name: 'app_mobil_index', methods: ['GET'])]
    public function index(MobilRepository $mobilRepository): Response
    {
        return $this->render('mobil/index.html.twig', [
            'mobils' => $mobilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mobil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MobilRepository $mobilRepository): Response
    {
        $mobil = new Mobil();
        $form = $this->createForm(MobilType::class, $mobil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mobilRepository->save($mobil, true);

            return $this->redirectToRoute('app_mobil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mobil/new.html.twig', [
            'mobil' => $mobil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobil_show', methods: ['GET'])]
    public function show(Mobil $mobil): Response
    {
        return $this->render('mobil/show.html.twig', [
            'mobil' => $mobil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mobil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mobil $mobil, MobilRepository $mobilRepository): Response
    {
        $form = $this->createForm(MobilType::class, $mobil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mobilRepository->save($mobil, true);

            return $this->redirectToRoute('app_mobil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mobil/edit.html.twig', [
            'mobil' => $mobil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobil_delete', methods: ['POST'])]
    public function delete(Request $request, Mobil $mobil, MobilRepository $mobilRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mobil->getId(), $request->request->get('_token'))) {
            $mobilRepository->remove($mobil, true);
        }

        return $this->redirectToRoute('app_mobil_index', [], Response::HTTP_SEE_OTHER);
    }
}
