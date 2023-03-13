<?php

namespace App\Controller;

use App\Repository\OpeningdayRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class LayoutController extends AbstractController
{
    /**
     * Footer     // https://symfony.com/doc/4.1/templating/embedding_controllers.html
     * @param RestaurantRepository $restaurantRepository
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeningService $openingService
     * @return Response
     */
    public function footer(RestaurantRepository $restaurantRepository, OpeningdayRepository $openingdayRepository, OpeningService $openingService): Response
    {
        $restaurant = $restaurantRepository->find(6);
        $openingdays = $openingdayRepository->findAll();
        $monday = $openingdayRepository->findOneBy(['day'=> 'lundi']);
        $tuesday = $openingdayRepository->findOneBy(['day'=> 'mardi']);
        $wednesday = $openingdayRepository->findOneBy(['day'=> 'mercredi']);
        $thirsday = $openingdayRepository->findOneBy(['day'=> 'jeudi']);
        $friday = $openingdayRepository->findOneBy(['day'=> 'vendredi']);
        $saturday = $openingdayRepository->findOneBy(['day'=> 'samedi']);
        $sunday = $openingdayRepository->findOneBy(['day'=> 'dimanche']);

        return $this->render('layout/footer.html.twig', [
            'restaurant' => $restaurant,
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHoursMonday' => $openingService->displayOpeningHours($monday),
            'openingHoursTuesday' => $openingService->displayOpeningHours($tuesday),
            'openingHoursWednesday' => $openingService->displayOpeningHours($wednesday),
            'openingHoursThirsday' => $openingService->displayOpeningHours($thirsday),
            'openingHoursFriday' => $openingService->displayOpeningHours($friday),
            'openingHoursSaturday' => $openingService->displayOpeningHours($saturday),
            'openingHoursSunday' => $openingService->displayOpeningHours($sunday),
        ]);
    }
}
