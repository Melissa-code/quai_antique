<?php

namespace App\Controller;


use App\Repository\DaytimeRepository;
use App\Repository\DishRepository;
use App\Repository\MenuRepository;
use App\Repository\SetmenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * Get and display the 4 menus including the setmenus with their dishes on Menu page
     * @param DaytimeRepository $daytimeRepository
     * @param MenuRepository $menuRepository
     * @param SetmenuRepository $setmenuRepository
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/menus', name: 'app_menus')]
    public function menu(DaytimeRepository $daytimeRepository, MenuRepository $menuRepository, SetmenuRepository $setmenuRepository, DishRepository $dishRepository): Response
    {
        $menus = $menuRepository->findAll();
        $daytimes = $daytimeRepository->findAll();
        $setmenus = $setmenuRepository->findAll();

        $startersMenu1 = $dishRepository->findDishesByCategory("entrées",  "jour");
        $dishesMenu1 = $dishRepository->findDishesByCategory("plats",  "jour");
        $dessertsMenu1 = $dishRepository->findDishesByCategory("desserts",  "jour");

        $startersMenu2 = $dishRepository->findDishesByCategory("entrées",  "dégustation");
        $dishesMenu2 = $dishRepository->findDishesByCategory("plats",  "dégustation");
        $dessertsMenu2 = $dishRepository->findDishesByCategory("desserts",  "dégustation");

        $startersMenu3 = $dishRepository->findDishesByCategory("entrées",  "burger");
        $dishesMenu3 = $dishRepository->findDishesByCategory("burgers",  "burger");
        $dessertsMenu3 = $dishRepository->findDishesByCategory("desserts",  "burger");

        $startersMenu4 = $dishRepository->findDishesByCategory("entrées",  "salade");
        $dishesMenu4 = $dishRepository->findDishesByCategory("salades",  "salade");
        $dessertsMenu4 = $dishRepository->findDishesByCategory("desserts",  "salade");

        return $this->render('menu/menus.html.twig', [
            'menus' => $menus,
            'daytimes'=> $daytimes,
            'setmenus' => $setmenus,

            'startersMenu1' => $startersMenu1,
            'dishesMenu1' => $dishesMenu1,
            'dessertsMenu1' => $dessertsMenu1,

            'startersMenu2' => $startersMenu2,
            'dishesMenu2' => $dishesMenu2,
            'dessertsMenu2' => $dessertsMenu2,

            'startersMenu3' => $startersMenu3,
            'dishesMenu3' => $dishesMenu3,
            'dessertsMenu3' => $dessertsMenu3,

            'startersMenu4' => $startersMenu4,
            'dishesMenu4' => $dishesMenu4,
            'dessertsMenu4' => $dessertsMenu4,
        ]);
    }
}
