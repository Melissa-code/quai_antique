<?php

namespace App\Controller;

use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Login
     *
     * @param AuthenticationUtils $authenticationUtils
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @return Response
     */
    #[Route(path: '/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository): Response
    {
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);

        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * Logout
     */
    #[Route(path: '/déconnexion', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
