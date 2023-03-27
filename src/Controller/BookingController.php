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

        //$noonStartTime = '12:00:00';
        //$noonEndTime = '13:15:00';
        //$eveningStartTime = '19:00:00';
        //$eveningEndTime = '21:15:00';

        // Hours of the days of the week
        $hoursOfMonday = $openingdayRepository->findOneBy(array('day'=>'lundi'))->getOpeninghours();
        if(!$hoursOfMonday->isEmpty()) {
            $noonStartTimeMonday = $bookingService->getNoonStartTime($hoursOfMonday);
            $noonEndTimeMonday = $bookingService->getNoonEndTime($hoursOfMonday);
            $eveningStartTimeMonday = $bookingService->getEveningStartTime($hoursOfMonday);
            $eveningEndTimeMonday = $bookingService->getEveningEndTime($hoursOfMonday);
            if(!empty($noonStartTimeMonday && $noonEndTimeMonday)) {
                $noonHoursMonday = $bookingService->getHoursBySlice($noonStartTimeMonday, $noonEndTimeMonday);
            } else {
                $noonHoursMonday = ["Fermé"];
            }
            if(!empty($eveningStartTimeMonday && $eveningEndTimeMonday)) {
                $eveningHoursMonday = $bookingService->getHoursBySlice($eveningStartTimeMonday, $eveningEndTimeMonday);
            } else {
                $eveningHoursMonday = ["Fermé"];
            }
        } else {
            $noonHoursMonday = ["Fermé"];
            $eveningHoursMonday = ["Fermé"];
            }

        $hoursOfTuesday = $openingdayRepository->findOneBy(array('day'=>'mardi'))->getOpeninghours();
        if(!$hoursOfTuesday->isEmpty()) {
            $noonStartTimeTuesday = $bookingService->getNoonStartTime($hoursOfTuesday);
            $noonEndTimeTuesday = $bookingService->getNoonEndTime($hoursOfTuesday);
            $eveningStartTimeTuesday = $bookingService->getEveningStartTime($hoursOfTuesday);
            $eveningEndTimeTuesday = $bookingService->getEveningEndTime($hoursOfTuesday);
            if(!empty($noonStartTimeTuesday && $noonEndTimeTuesday )) {
                $noonHoursTuesday = $bookingService->getHoursBySlice($noonStartTimeTuesday, $noonEndTimeTuesday );
            } else {
                $noonHoursTuesday = ["Fermé"];
            }
            if(!empty($eveningStartTimeTuesday && $eveningEndTimeTuesday)) {
                $eveningHoursTuesday = $bookingService->getHoursBySlice($eveningStartTimeTuesday, $eveningEndTimeTuesday);
            } else {
                $eveningHoursTuesday = ["Fermé"];
            }
        } else {
            $noonHoursTuesday = ["Fermé"];
            $eveningHoursTuesday = ["Fermé"];
        }

        $hoursOfWednesday = $openingdayRepository->findOneBy(array('day'=>'mercredi'))->getOpeninghours();
        if(!$hoursOfWednesday->isEmpty()){
            $noonStartTimeWednesday = $bookingService->getNoonStartTime($hoursOfWednesday);
            $noonEndTimeWednesday = $bookingService->getNoonEndTime($hoursOfWednesday);
            $eveningStartTimeWednesday = $bookingService->getEveningStartTime($hoursOfWednesday);
            $eveningEndTimeWednesday = $bookingService->getEveningEndTime($hoursOfWednesday);
            if(!empty($noonStartTimeWednesday && $noonEndTimeWednesday)) {
                $noonHoursWednesday = $bookingService->getHoursBySlice( $noonStartTimeWednesday, $noonEndTimeWednesday);
            } else {
                $noonHoursWednesday = ["Fermé"];
            }
            if(!empty($eveningStartTimeWednesday && $eveningEndTimeWednesday)) {
                $eveningHoursWednesday = $bookingService->getHoursBySlice($eveningStartTimeWednesday, $eveningEndTimeWednesday);
            } else {
                $eveningHoursWednesday = ["Fermé"];
            }
        } else {
            $noonHoursWednesday = ["Fermé"];
            $eveningHoursWednesday = ["Fermé"];
        }

        $hoursOfThursday = $openingdayRepository->findOneBy(array('day'=>'jeudi'))->getOpeninghours();
        if(!$hoursOfThursday->isEmpty()){
            $noonStartTimeThursday = $bookingService->getNoonStartTime($hoursOfThursday);
            $noonEndTimeThursday = $bookingService->getNoonEndTime($hoursOfThursday);
            $eveningStartTimeThursday = $bookingService->getEveningStartTime($hoursOfThursday);
            $eveningEndTimeThursday = $bookingService->getEveningEndTime($hoursOfThursday);
            if(!empty($noonStartTimeThursday && $noonEndTimeThursday)) {
                $noonHoursThursday = $bookingService->getHoursBySlice($noonStartTimeThursday, $noonEndTimeThursday);
            } else {
                $noonHoursThursday = ["Fermé"];
            }
            if(!empty($eveningStartTimeThursday && $eveningEndTimeThursday)) {
                $eveningHoursThursday = $bookingService->getHoursBySlice($eveningStartTimeThursday, $eveningEndTimeThursday);
            } else {
                $eveningHoursThursday = ["Fermé"];
            }
        } else {
            $noonHoursThursday = ["Fermé"];
            $eveningHoursThursday = ["Fermé"];
        }

        $hoursOfFriday = $openingdayRepository->findOneBy(array('day'=>'vendredi'))->getOpeninghours();
        if(!$hoursOfFriday->isEmpty()){
            $noonStartTimeFriday = $bookingService->getNoonStartTime($hoursOfFriday);
            $noonEndTimeFriday = $bookingService->getNoonEndTime($hoursOfFriday);
            $eveningStartTimeFriday = $bookingService->getEveningStartTime($hoursOfFriday);
            $eveningEndTimeFriday = $bookingService->getEveningEndTime($hoursOfFriday);
            if(!empty($noonStartTimeFriday && $noonEndTimeFriday)) {
                $noonHoursFriday = $bookingService->getHoursBySlice($noonStartTimeFriday, $noonEndTimeFriday);
            } else {
                $noonHoursFriday  = ["Fermé"];
            }
            if(!empty($eveningStartTimeFriday && $eveningEndTimeFriday)) {
                $eveningHoursFriday = $bookingService->getHoursBySlice($eveningStartTimeFriday, $eveningEndTimeFriday);
            } else {
                $eveningHoursFriday = ["Fermé"];
            }
        } else {
            $noonHoursFriday  = ["Fermé"];
            $eveningHoursFriday = ["Fermé"];
        }

        $hoursOfSaturday = $openingdayRepository->findOneBy(array('day'=>'samedi'))->getOpeninghours();
        if(!$hoursOfSaturday->isEmpty()){
            $noonStartTimeSaturday = $bookingService->getNoonStartTime($hoursOfSaturday);
            $noonEndTimeSaturday = $bookingService->getNoonEndTime($hoursOfSaturday);
            $eveningStartTimeSaturday = $bookingService->getEveningStartTime($hoursOfSaturday);
            $eveningEndTimeSaturday = $bookingService->getEveningEndTime($hoursOfSaturday);
            if(!empty($noonStartTimeSaturday && $noonEndTimeSaturday)) {
                $noonHoursSaturday = $bookingService->getHoursBySlice($noonStartTimeSaturday, $noonEndTimeSaturday);
            } else {
                $noonHoursSaturday  = ["Fermé"];
            }
            if(!empty($eveningStartTimeSaturday && $eveningEndTimeSaturday)) {
                $eveningHoursSaturday = $bookingService->getHoursBySlice($eveningStartTimeSaturday, $eveningEndTimeSaturday);
            } else {
                $eveningHoursSaturday = ["Fermé"];
            }
        } else {
            $noonHoursSaturday  = ["Fermé"];
            $eveningHoursSaturday = ["Fermé"];
        }

        $hoursOfSunday = $openingdayRepository->findOneBy(array('day'=>'dimanche'))->getOpeninghours();
        if(!$hoursOfSunday->isEmpty()){
            $noonStartTimeSunday = $bookingService->getNoonStartTime($hoursOfSunday);
            $noonEndTimeSunday = $bookingService->getNoonEndTime($hoursOfSunday);
            $eveningStartTimeSunday = $bookingService->getEveningStartTime($hoursOfSunday);
            $eveningEndTimeSunday = $bookingService->getEveningEndTime($hoursOfSunday);
            if(!empty($noonStartTimeSunday && $noonEndTimeSunday)) {
                $noonHoursSunday = $bookingService->getHoursBySlice($noonStartTimeSunday, $noonEndTimeSunday);
            } else {
                $noonHoursSunday = ["Fermé"];
            }
            if(!empty($eveningStartTimeSunday && $eveningEndTimeSunday)) {
                $eveningHoursSunday = $bookingService->getHoursBySlice($eveningStartTimeSunday, $eveningEndTimeSunday);
            } else {
                $eveningHoursSunday = ["Fermé"];
            }
        } else {
            $noonHoursSunday = ["Fermé"];
            $eveningHoursSunday = ["Fermé"];
        }

        //dd($eveningHoursSunday);

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $bookedAtSelected = $booking->getBookedAt(); // Get the date
            $dayOfBookedAt = $bookedAtSelected->format("D"); // Get the day of the date
            $dayOfBookedAt = $bookingService->translateToFrench($dayOfBookedAt);
            // Find the Openingday object by the value of the day
            $openingDay = $openingdayRepository->findOneBy(array('day'=> $dayOfBookedAt));
            $booking->setOpeningday($openingDay);

            // Check if the user is logged-in to make a booking
            if($user) {
                //$managerRegistry->getManager()->persist($booking);
                //$managerRegistry->getManager()->flush();
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
            'form' => $form->createView(),
        ]);
    }
}
