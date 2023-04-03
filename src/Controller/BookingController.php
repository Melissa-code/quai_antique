<?php

namespace App\Controller;


use App\Entity\Booking;
use App\Entity\Openingday;
use App\Form\BookingType;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\BookingService;

use DateTime;
use Doctrine\DBAL\Types\TimeImmutableType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BookingController extends AbstractController
{
    #[Route('/reservation', name: 'app_booking')]
    public function book(RestaurantRepository $restaurantRepository, Request $request, ManagerRegistry $managerRegistry, BookingService $bookingService, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository): Response
    {
        $booking = new Booking();
        $date = new \DateTimeImmutable();
        $booking->setCreatedAt($date);
        $restaurant = $restaurantRepository->findOneBy(array('name'=> "Le Quai Antique"));
        $booking->setRestaurant($restaurant);
        $user = $this->getUser();
        $booking->setUser($user);

        // Hours of the days of the week
        $hoursOfMonday = $openingdayRepository->findOneBy(array('day'=>'lundi'))->getOpeninghours();
        $noonHoursMonday = $bookingService->getNoonHoursOfTheDay($hoursOfMonday);
        $eveningHoursMonday = $bookingService->getEveningHoursOfTheDay($hoursOfMonday);

        $hoursOfTuesday = $openingdayRepository->findOneBy(array('day'=>'mardi'))->getOpeninghours();
        $noonHoursTuesday = $bookingService->getNoonHoursOfTheDay($hoursOfTuesday);
        $eveningHoursTuesday = $bookingService->getEveningHoursOfTheDay($hoursOfTuesday);

        $hoursOfWednesday = $openingdayRepository->findOneBy(array('day'=>'mercredi'))->getOpeninghours();
        $noonHoursWednesday = $bookingService->getNoonHoursOfTheDay($hoursOfWednesday);
        $eveningHoursWednesday = $bookingService->getEveningHoursOfTheDay($hoursOfWednesday);

        $hoursOfThursday = $openingdayRepository->findOneBy(array('day'=>'jeudi'))->getOpeninghours();
        $noonHoursThursday = $bookingService->getNoonHoursOfTheDay($hoursOfThursday);
        $eveningHoursThursday = $bookingService->getEveningHoursOfTheDay($hoursOfThursday);

        $hoursOfFriday = $openingdayRepository->findOneBy(array('day'=>'vendredi'))->getOpeninghours();
        $noonHoursFriday = $bookingService->getNoonHoursOfTheDay($hoursOfFriday);
        $eveningHoursFriday = $bookingService->getEveningHoursOfTheDay($hoursOfFriday);

        $hoursOfSaturday = $openingdayRepository->findOneBy(array('day'=>'samedi'))->getOpeninghours();
        $noonHoursSaturday = $bookingService->getNoonHoursOfTheDay($hoursOfSaturday);
        $eveningHoursSaturday = $bookingService->getEveningHoursOfTheDay($hoursOfSaturday);

        $hoursOfSunday = $openingdayRepository->findOneBy(array('day'=>'dimanche'))->getOpeninghours();
        $noonHoursSunday = $bookingService->getNoonHoursOfTheDay($hoursOfSunday);
        $eveningHoursSunday= $bookingService->getEveningHoursOfTheDay($hoursOfSunday);
        //dd($eveningHoursSunday);

        // Form
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $bookedAtSelected = $booking->getBookedAt(); // Get the date
            $dayOfBookedAt = $bookedAtSelected->format("D"); // Get the day of the date
            $dayOfBookedAt = $bookingService->translateToFrench($dayOfBookedAt);
            // Find the Openingday object by the value of the day
            $openingDay = $openingdayRepository->findOneBy(array('day'=> $dayOfBookedAt));
            $booking->setOpeningday($openingDay);

            // Get the value of the start hour button checked by the user
            $startAt = $request->request->get('startAt');
            $booking->setStartAt(new DateTime($startAt));
            //echo gettype($startAt); //string

            // Find the opening hour of the day by the start time
            $openingDay = $booking->getOpeningday()->getDay();
            $openingHour = $openinghourRepository->findOneByHours($startAt, $openingDay);
            //dd($openingHour); //Array
            $booking->setOpeninghour($openingHour);

            // Check if the user is logged-in to make a booking
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
            'noonHoursMonday' => $noonHoursMonday,
            'eveningHoursMonday' => $eveningHoursMonday,
            'noonHoursTuesday' =>  $noonHoursTuesday,
            'eveningHoursTuesday' => $eveningHoursTuesday,
            'noonHoursWednesday' => $noonHoursWednesday,
            'eveningHoursWednesday' => $eveningHoursWednesday,
            'noonHoursThursday' => $noonHoursThursday,
            'eveningHoursThursday' => $eveningHoursThursday,
            'noonHoursFriday' => $noonHoursFriday,
            'eveningHoursFriday' => $eveningHoursFriday,
            'noonHoursSaturday' => $noonHoursSaturday,
            'eveningHoursSaturday' => $eveningHoursSaturday,
            'noonHoursSunday' => $noonHoursSunday,
            'eveningHoursSunday' => $eveningHoursSunday,
            'days' => $openingdayRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
