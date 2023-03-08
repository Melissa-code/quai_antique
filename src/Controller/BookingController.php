<?php

namespace App\Controller;

use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]
    public function book(OpeningService $openingService, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, RestaurantRepository $restaurantRepository): Response
    {
        // Opening days & hours of the restaurant for the footer
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);

        return $this->render('booking/booking.html.twig', [
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,
        ]);
    }
}
