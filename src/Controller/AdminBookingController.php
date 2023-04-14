<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\RestaurantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * List of the bookings
     * @param BookingRepository $bookingRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/reservations', name: 'app_admin_booking')]
    public function bookings(BookingRepository $bookingRepository, PaginatorInterface $paginator, Request $request, RestaurantRepository $restaurantRepository): Response
    {
        $maximumGuests = $restaurantRepository->find(6)->getNbseatings() - 10;

        // Pagination (4 ascending bookings a page)
        $bookings = $paginator->paginate(
            $bookingRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            4 /* limit per page */
        );

        return $this->render('admin/admin_booking/bookings.html.twig', [
            'maximumGuests' => $maximumGuests,
            'bookings' => $bookings,
        ]);
    }
}
