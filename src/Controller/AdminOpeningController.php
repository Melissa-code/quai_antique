<?php

namespace App\Controller;

use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOpeningController extends AbstractController
{
    #[Route('/admin/horaires_ouverture', name: 'app_admin_opening')]
    public function openingDaysHours(OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository): Response
    {
        // Variables for the footer
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);


        return $this->render('admin/admin_opening/openingDaysHours.html.twig', [
            'openingdays' => $openingdays,
            'openinghours' => $openinghours,
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,
        ]);
    }
}
