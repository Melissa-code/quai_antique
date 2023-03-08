<?php

namespace App\Controller;

use App\Entity\Openingday;
use App\Entity\Openinghour;
use App\Repository\DishRepository;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
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
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();

//        $noon = "12:00-14:00";
//        $evening = "19:00-22:00";
//        $eveningSaturday = "19:00-23:00";

        return $this->render('home/home.html.twig', [
            "favoriteDishes" => $favoriteDishes,
            "admin" => false,

//            "noon"=> $noon,
//            "evening" => $evening,
//            "eveningSaturday" => $eveningSaturday,
            "openingDay" => $openingService->displayOpeningDays($openingdays),
            "openingHour" => $openingService->displayOpeningHours($openinghours, $openingdays),
        ]);
    }



}
