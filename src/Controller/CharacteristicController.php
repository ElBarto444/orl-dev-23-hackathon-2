<?php

namespace App\Controller;

use App\Entity\Characteristic;
use App\Form\CharacteristicType;
use App\Repository\CharacteristicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/characteristic')]
class CharacteristicController extends AbstractController
{
    #[Route('/', name: 'app_characteristic_index', methods: ['GET'])]
    public function index(CharacteristicRepository $characteristicRepository): Response
    {
        return $this->render('characteristic/index.html.twig', [
            'characteristics' => $characteristicRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_characteristic_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CharacteristicRepository $characteristicRepository): Response
    {
        $characteristic = new Characteristic();
        $form = $this->createForm(CharacteristicType::class, $characteristic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characteristicRepository->save($characteristic, true);

            return $this->redirectToRoute('app_characteristic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('characteristic/new.html.twig', [
            'characteristic' => $characteristic,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_characteristic_show', methods: ['GET'])]
    public function show(Characteristic $characteristic): Response
    {
        return $this->render('characteristic/show.html.twig', [
            'characteristic' => $characteristic,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_characteristic_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Characteristic $characteristic, CharacteristicRepository $characteristicRepository): Response
    {
        $form = $this->createForm(CharacteristicType::class, $characteristic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characteristicRepository->save($characteristic, true);

            return $this->redirectToRoute('app_characteristic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('characteristic/edit.html.twig', [
            'characteristic' => $characteristic,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_characteristic_delete', methods: ['POST'])]
    public function delete(Request $request, Characteristic $characteristic, CharacteristicRepository $characteristicRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$characteristic->getId(), $request->request->get('_token'))) {
            $characteristicRepository->remove($characteristic, true);
        }

        return $this->redirectToRoute('app_characteristic_index', [], Response::HTTP_SEE_OTHER);
    }
}
