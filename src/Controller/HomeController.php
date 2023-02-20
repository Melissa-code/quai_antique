<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository): Response
    {
        //$dishes = $dishRepository->findAll();
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);
        //dd($favoriteDishes);

        return $this->render('home/home.html.twig', [
            //"dishes" => $dishes,
            "favoriteDishes" => $favoriteDishes,
        ]);
    }



}
