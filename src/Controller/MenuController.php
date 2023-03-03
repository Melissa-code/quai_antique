<?php

namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\DaytimeRepository;
use App\Repository\DishRepository;
use App\Repository\MenuRepository;
use App\Repository\SetmenuRepository;
use App\Service\MenuService;
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
     * @param CategoryRepository $categoryRepository
     * @param MenuService $menuService
     * @return Response
     */
    #[Route('/menus', name: 'app_menus')]
    public function menu(DaytimeRepository $daytimeRepository, MenuRepository $menuRepository, SetmenuRepository $setmenuRepository, DishRepository $dishRepository, CategoryRepository $categoryRepository, MenuService $menuService): Response
    {
        $menus = $menuRepository->findAll();
        $daytimes = $daytimeRepository->findAll();
        $setmenus = $setmenuRepository->findAll();
        //$dishes = $dishRepository->findAll();
        //$categories = $categoryRepository->findAll();

        $startersMenu1 = $dishRepository->findDishesByCategory("entrées",  1);
        $dishesMenu1 = $dishRepository->findDishesByCategory("plats",  1);
        $dessertsMenu1 = $dishRepository->findDishesByCategory("desserts",  1);

        $startersMenu2 = $dishRepository->findDishesByCategory("entrées",  3);
        $dishesMenu2 = $dishRepository->findDishesByCategory("plats",  3);
        $dessertsMenu2 = $dishRepository->findDishesByCategory("desserts",  3);

        $startersMenu3 = $dishRepository->findDishesByCategory("entrées",  5);
        $dishesMenu3 = $dishRepository->findDishesByCategory("burgers",  5);
        $dessertsMenu3 = $dishRepository->findDishesByCategory("desserts",  5);

        $startersMenu4 = $dishRepository->findDishesByCategory("entrées",  7);
        $dishesMenu4 = $dishRepository->findDishesByCategory("salades",  7);
        $dessertsMenu4 = $dishRepository->findDishesByCategory("desserts",  7);


        return $this->render('menu/menus.html.twig', [
            'menus' => $menus,
            'daytimes'=> $daytimes,
            'setmenus' => $setmenus,
            ///'dishes' => $dishes,
            //'categories' => $categories,

            'startersMenu1' =>  $startersMenu1,
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
