<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * List of the bookings
     * @param BookingRepository $bookingRepository
     * @return Response
     */
    #[Route('/admin/reservations', name: 'app_admin_booking')]
    public function bookings(BookingRepository $bookingRepository): Response
    {
        $bookings = $bookingRepository->findAll();


        return $this->render('admin/admin_booking/bookings.html.twig', [
            'bookings' => $bookings,

        ]);
    }
}
