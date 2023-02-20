<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DishRepository;
use App\Service\CategoryService;
use App\Service\DishService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends AbstractController
{
    #[Route('/dish', name: 'app_dish')]
    public function index(DishRepository $dishRepository, DishService $dishService, CategoryRepository $categoryRepository, CategoryService $categoryService): Response
    {
        $dishes = $dishRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('dish/index.html.twig', [
            "dishes" => $dishService->displayDishes($categories, $dishes),
            "categories" => $categoryService->displayTitleCategories($categories),
            "imagesCategories" =>$categoryService->displayImageCategories($categories),
            "evenCategories" => $categoryService->evenCategories($categories),

            ]);
    }
}
