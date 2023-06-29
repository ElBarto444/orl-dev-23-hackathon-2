<?php

namespace App\Controller;

use App\Entity\Calculator;
use App\Entity\Characteristic;
use App\Form\CharacteristicType;
use App\Repository\CharacteristicRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $calculator = new Calculator();
        $characteristic = new Characteristic();
        $form = $this->createForm(CharacteristicType::class, $characteristic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dataRAM = $form['RAM']->getData();
            $dataStorage = $form['stockage']->getData();

            foreach (Calculator::MEMORY_VAL as $keyRam => $valueRam) {
                if ($dataRAM === $keyRam) {
                    $ramVal = $valueRam;
                }
            }
    
            //loop in the storage_val const to find matching value on entered storage parameter
            foreach (Calculator::STORAGE_VAL as $keyStorage => $valueStorage) {
                if ($dataStorage === $keyStorage) {
                    $storageVal = $valueStorage;
                }
            }
    
            //get data from new mobile form and add the two values
            $sum = $storageVal + $ramVal;
            //deduce percentage from the resulting score
            $reduce = $sum * $calculator->getPricingPercentage();
            $result = $sum - $reduce;
    
            //set the phone's category in a switch statement
            switch ($result) {
                case ($result <= 60):
                    $characteristic->setCategory('1 - HC');
                    break;
                case ($result <= 90):
                    $characteristic->setCategory('2 - C');
                    break;
                case ($result <= 150):
                    $characteristic->setCategory('3 - B');
                    break;
                case ($result <= 250):
                    $characteristic->setCategory('4 - A');
                    break;
                case ($result > 250):
                    $characteristic->setCategory('5 - Premium');
                    break;
            }
            $characteristicRepository->save($characteristic, true);

            return $this->redirectToRoute('app_characteristic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('characteristic/new.html.twig', [
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

        return $this->render('characteristic/edit.html.twig', [
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
