<?php

namespace App\Controller;

use App\Repository\DishRepository;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Display the favorite dishes in the photos gallery
     * @param DishRepository $dishRepository
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);

        return $this->render('home/home.html.twig', [
            'favoriteDishes' => $favoriteDishes,
            'admin' => false,
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,
            ]);
    }



}
