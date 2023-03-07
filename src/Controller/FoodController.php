<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DishRepository;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
// use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * Get and display all the dishes on the La Carte page
     * @param CategoryRepository $categoryRepository
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/la_carte', name: 'app_food')]
    public function dishes(CategoryRepository $categoryRepository, DishRepository $dishRepository, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService): Response
    {
        $categories = $categoryRepository->findAll();
        $dishes = $dishRepository->findDishesByAscendingPrice();

        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();

        $noon = "12:00-14:00";
        $evening = "19:00-22:00";
        $eveningSaturday = "19:00-23:00";

        return $this->render('food/food.html.twig', [
            'categories' => $categories,
            'dishes' => $dishes,

            "noon"=> $noon,
            "evening" => $evening,
            "eveningSaturday" => $eveningSaturday,
            "opening" => $openingService->displayOpeningDays($openingdays),
        ]);
    }
}
