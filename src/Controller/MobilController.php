<?php

namespace App\Controller;

use App\Entity\Mobil;
use App\Form\MobilType;
use App\Entity\Category;
use App\Entity\Calculator;
use App\Repository\MobilRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CalculatorService;
use App\Form\SearchSmartphoneType;

#[Route('/mobil')]
class MobilController extends AbstractController
{
    #[Route('/', name: 'app_mobil_index', methods: ['GET'])]
    public function index(Request $request, MobilRepository $mobilRepository): Response
    {
        $form = $this->createForm(SearchSmartphoneType::class);
        $form->handleRequest($request);

        $mobils = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];

            $mobils = $mobilRepository->findMobil($search);
        } else {
            $mobils = $mobilRepository->findAll();
        }

        return $this->render('mobil/index.html.twig', [
            'mobils' => $mobils,
            'form' => $form->createView(),

        ]);
    }

    #[Route('/new', name: 'app_mobil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MobilRepository $mobilRepository): Response
    {
        $mobil = new Mobil();
        $calculator = new Calculator();

        $form = $this->createForm(MobilType::class, $mobil);
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
                    $mobil->setCategoryName('1 - HC');
                    break;
                case ($result <= 90):
                    $mobil->setCategoryName('2 - C');
                    break;
                case ($result <= 150):
                    $mobil->setCategoryName('3 - B');
                    break;
                case ($result <= 250):
                    $mobil->setCategoryName('4 - A');
                    break;
                case ($result > 250):
                    $mobil->setCategoryName('5 - Premium');
                    break;
            }
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
        $category = new Category();
        $name = $category->getName();

        return $this->render('mobil/show.html.twig', [
            'mobil' => $mobil,
            'name' => $name,
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
        if ($this->isCsrfTokenValid('delete' . $mobil->getId(), $request->request->get('_token'))) {
            $mobilRepository->remove($mobil, true);
        }

        return $this->redirectToRoute('app_mobil_index', [], Response::HTTP_SEE_OTHER);
    }
}

// namespace App\Controller;

// use App\Repository\CharacteristicRepository;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
// use Symfony\Component\Form\Extension\Core\Type\SearchType;


// class AccueilController extends AbstractController
// {
//     #[Route('/home', name: 'app_accueil')]
//     public function index(
//         Request $request,
//         CharacteristicRepository $characteristicRepository,
//     ): Response {
//         $form = $this->createForm(SearchSmartphoneType::class);
//         $form->handleRequest($request);

//         $characteristics = [];
//         if ($form->isSubmitted() && $form->isValid()) {
//             $search = $form->getData()['search'];

//             $characteristics = $characteristicRepository->findCharacteristic($search);
//         } else {
//             $characteristics = $characteristicRepository->findAll();
//         }

//         return $this->render('accueil/index.html.twig', [
//             'characteristics' => $characteristics,
//             'form' => $form->createView(),
//         ]);
//     }
// }
