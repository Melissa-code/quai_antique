<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * La Carte : Get and display all the dishes
     * @param CategoryRepository $categoryRepository
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/la_carte', name: 'app_food')]
    public function dishes(CategoryRepository $categoryRepository, DishRepository $dishRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $dishes = $dishRepository->findDishesByAscendingPrice();

        return $this->render('food/food.html.twig', [
            'categories' => $categories,
            'dishes' => $dishes,
        ]);
    }

}
