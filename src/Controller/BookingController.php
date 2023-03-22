<?php

namespace App\Controller;


use App\Entity\Allergy;
use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]
    public function book(): Response
    {
        $booking = new Booking();
        for($i = 0; $i < 1; $i++) {
            $allergy = new Allergy();
            $booking->addAllergy($allergy);
        }
        $form = $this->createForm(BookingType::class, $booking);

        return $this->render('booking/booking.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }
}
