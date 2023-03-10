<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Entity\Openingday;
use App\Entity\Openinghour;
use App\Form\OpeningdayType;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class AdminOpeningController extends AbstractController
{
    /**
     * List the opening days and their opening hours
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/horaires_ouverture', name: 'app_admin_opening')]
    public function openingDaysHours(OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Variables for the footer
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);

        // Pagination (4 days per page) : $days replace $openingdays
        $days = $paginator->paginate(
            $openingdayRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            4 /* limit per page */
        );

        return $this->render('admin/admin_opening/openingDaysHours.html.twig', [
            'openingdays' => $days,
            'openinghours' => $openinghours,
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * Update an opening day and its hours
     * @param Openingday $openingday
     * @param Openinghour $openinghour
     * @param ManagerRegistry $managerRegistry
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/modification_horaires{id}', name: 'app_admin_updateOpening', methods: 'GET|POST')]
    #[Entity('openingday', expr: 'repository.find(id)')]
    public function updateOpening(Openingday $openingday, Openinghour $openinghour, ManagerRegistry $managerRegistry, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository, Request $request): Response
    {
        // Variables for the footer
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $restaurant = $restaurantRepository->find(6);

        $isUpdated = true;

        $form = $this->createForm(OpeningdayType::class, $openingday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the changes in the database
            $managerRegistry->getManager()->persist($openingday);
            $managerRegistry->getManager()->flush();
        }

        return $this->render('admin/admin_opening/createUpdate.html.twig', [
            'openingDay' => $openingService->displayOpeningDays($openingdays),
            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
            'restaurant' => $restaurant,

            'openingdays' => $openingdays,
            'openinghours' => $openinghours,
            'isUpdated' =>  $isUpdated,
            'form' => $form->createView(),
        ]);
    }



}
