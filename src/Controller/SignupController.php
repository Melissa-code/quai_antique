<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SignupController extends AbstractController
{
    /**
     * Sign up
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @param ManagerRegistry $managerRegistry
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @return Response
     */
    #[Route('/inscription', name: 'app_signup')]
    public function signup(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $managerRegistry, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository): Response
    {
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);

        $user = new User();
        $form = $this->createForm(SignupType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // Hash the password
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            // Save the new user data in the database
            $managerRegistry->getManager()->persist($user);
            $managerRegistry->getManager()->flush();

            // Redirect the user to the home page
            return $this->redirectToRoute('app_home');
        }

        return $this->render('signup/signup.html.twig', [
            'form' => $form->createView(),
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,
        ]);
    }
}
