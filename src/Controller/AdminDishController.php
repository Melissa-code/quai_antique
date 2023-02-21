<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDishController extends AbstractController
{
    /**
     * Display the add update & delete buttons on the home page
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/admin/plats', name: 'app_admin_dish')]
    public function homeAdmin(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        return $this->render('home/home.html.twig', [
            "favoriteDishes" => $favoriteDishes,
            "admin" => true,
        ]);
    }

    /**
     * Update a dish form
     * @param Dish $dish
     * @return Response
     */
    #[Route('/admin/modifier_plat{id}', name: 'app_admin_update_dish')]
    public function updateDish(Dish $dish): Response
    {
        $form = $this->createForm(DishType::class, $dish);

        return $this->render('admin_dish/update.html.twig', [
            "form" => $form->createView(),
            "dish" => $dish,
        ]);
    }


}
