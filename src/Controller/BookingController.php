<?php

namespace App\Controller;


use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\RestaurantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/reservation', name: 'app_booking')]
    public function book(RestaurantRepository $restaurantRepository, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $booking = new Booking();

        $date = new \DateTimeImmutable();
        $booking->setCreatedAt($date);

        $restaurant = $restaurantRepository->find(6);
        $booking->setRestaurant($restaurant);

        $user = $this->getUser();
        $booking->setUser($user);
        //dd($booking->getUser());

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // Check if the user is logged in
            if($user) {
                $managerRegistry->getManager()->persist($booking);
                $managerRegistry->getManager()->flush();
                $this->addFlash("success", "La réservation a bien été effectuée.");
                $this->redirectToRoute('app_login');
            } else {
                $this->addFlash("error", "Vous devez être connecté pour effectuer une réservation");
                $this->redirectToRoute('app_home');
            }
        }

        return $this->render('booking/booking.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }
}
