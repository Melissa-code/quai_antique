<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Display the favorite dishes in the photos gallery
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        $noon = "12:00-14:00";
        $evening = "19:00-22:00";
        $eveningSaturday = "19:00-23:00";

        return $this->render('home/home.html.twig', [
            "favoriteDishes" => $favoriteDishes,
            "admin" => false,
            "noon"=> $noon,
            "evening" => $evening,
            "eveningSaturday" => $eveningSaturday,
        ]);
    }



}
