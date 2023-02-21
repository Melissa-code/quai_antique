<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDishController extends AbstractController
{
    #[Route('/admin/plats', name: 'app_admin_dish')]
    public function homeAdmin(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        //return $this->render('admin_dish/dish.html.twig', []);
        return $this->render('home/home.html.twig', [
            "favoriteDishes" => $favoriteDishes,
            "admin" => true,
        ]);
    }
}
