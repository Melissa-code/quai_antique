<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * Get and display the favorite dishes in the photos gallery of the home page
     * @param DishRepository $dishRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository, Request $request): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        return $this->render('home/home.html.twig', [
            'favoriteDishes' => $favoriteDishes,
            'admin' => false,
            ]);
    }

}
