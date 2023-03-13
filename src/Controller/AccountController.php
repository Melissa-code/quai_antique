<?php

namespace App\Controller;

use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * User account
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @return Response
     */
    #[Route('/compte', name: 'app_account')]
    public function account(OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('account/account.html.twig', [
        ]);
    }
}
