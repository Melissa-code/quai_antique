<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Home page & the favorite dishes in the photos gallery
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        return $this->render('home/home.html.twig', [
            'favoriteDishes' => $favoriteDishes,
            'admin' => false,
            ]);
    }

}
