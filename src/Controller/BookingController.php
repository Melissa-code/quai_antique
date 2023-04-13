<?php

namespace App\Controller;


use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
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
    public function book(RestaurantRepository $restaurantRepository, Request $request, ManagerRegistry $managerRegistry, BookingService $bookingService, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, BookingRepository $bookingRepository): Response
    {
        //$language = $request->server->get('HTTP_ACCEPT_LANGUAGE');
    	//dd($language);

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

            // Find the opening hour of the day by the start time
            $openingDay = $booking->getOpeningday()->getDay();
            $openingHour = $openinghourRepository->findOneByHours($startAt, $openingDay);
            $booking->setOpeninghour($openingHour);

            // Check if the user is logged-in to make a booking
            if($user) {
                // Check if a date and hour of booking already exist in the DB
                $bookingsDate = $bookingRepository->findBy(array('bookedAt' => $bookedAtSelected, 'openinghour' => $booking->getOpeninghour()));

                if($bookingsDate) {
                    echo 'date de résa existe déjà';
                    $guests = [];
                    foreach ($bookingsDate as $bookingDate) {
                        if($bookingDate->getBookedAt() == $bookedAtSelected && $bookingDate->getOpeninghour() == $booking->getOpeninghour()) {
                            $guests[] .= $bookingDate->getGuest()->getQuantity();
                        }
                    }
                    $nbGuests = array_sum($guests) + $booking->getGuest()->getQuantity();
                    echo '  Total nb d invités à la même date: ' . $nbGuests;
                    $remainingSeats = ($restaurant->getNbseatings() - $nbGuests);
                    $booking->setRemainingseats($remainingSeats);
                    echo '  Places restantes ' . $remainingSeats;

                    // Check the limit of the guests
                    if ($booking->getRemainingseats() < 52) {
                        echo '  Nb de Places restantes à la même date si < 52 : ' . $booking->getRemainingseats();
                        $this->addFlash("error", "Réservation impossible, le restaurant est complet.");

                    } else {
                        echo '  Réservation Enregistrée';
                        //$managerRegistry->getManager()->persist($booking);
                        //$managerRegistry->getManager()->flush();
                        $this->addFlash("success", "La réservation a bien été effectuée.");
                        return $this->redirectToRoute('app_account');
                    }
                } else {
                    $remainingSeats = $restaurant->getNbseatings() - $booking->getGuest()->getQuantity();
                    $booking->setRemainingseats($remainingSeats) ;
                    echo 'total places restantes : '.$remainingSeats;
                    echo 'date de résa n existe pas';
                    //$managerRegistry->getManager()->persist($booking);
                    //$managerRegistry->getManager()->flush();
                    $this->addFlash("success", "La réservation a bien été effectuée.");
                    return $this->redirectToRoute('app_account');
                }

            } else {
                $this->addFlash("error", "Vous devez vous connecter pour effectuer une réservation.");
                return $this->redirectToRoute('app_login');
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

    /**
     * Put all the booking in a array and return it in a JSON format
     * @param BookingRepository $bookingRepository
     * @return Response
     */
    #[Route('/reservations', name: 'app_bookings')]
    public function bookings(BookingRepository $bookingRepository): Response
    {
        $bookings = $bookingRepository->findAll();
        $arrayOfBookings = [];

        foreach ($bookings as $booking) {
            $arrayOfBookings[] = $booking->toArray();
        }
        return $this->json($arrayOfBookings);
    }

}
