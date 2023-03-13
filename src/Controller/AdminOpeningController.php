<?php

namespace App\Controller;


use App\Entity\Openingday;
use App\Form\OpeningdayType;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use App\Repository\RestaurantRepository;
use App\Service\OpeningService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class AdminOpeningController extends AbstractController
{
    /**
     * List the opening days and their hours
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
        $openinghours = $openinghourRepository->findAll();

        // Pagination (4 days per page) : $days replace $openingdays = $openingdayRepository->findAll();
        $days = $paginator->paginate(
            $openingdayRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            4 /* limit per page */
        );

        return $this->render('admin/admin_opening/openingDaysHours.html.twig', [
            'openingdays' => $days,
            'openinghours' => $openinghours,
        ]);
    }


    /**
     * Create an opening day and its hours
     * @param ManagerRegistry $managerRegistry
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @param Request $request
     * @return Response
     */
//    #[Route('/admin/ajout_horaires', name: 'app_admin_createOpening')]
//    public function createOpening(ManagerRegistry $managerRegistry, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, OpeningService $openingService, RestaurantRepository $restaurantRepository, Request $request): Response
//    {
//        // Variables for the footer
//        $openingdays = $openingdayRepository->findAll();
//        $openinghours = $openinghourRepository->findAll();
//        $restaurant = $restaurantRepository->find(6);
//
//        $isUpdated = false;
//        $openingday = new Openingday();
//        for($i = 0; $i < 2; $i++) {
//            $openinghour = new Openinghour();
//            $openingday->addOpeninghour($openinghour);
//        }
//        $form = $this->createForm(OpeningdayType::class, $openingday);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            // Check if the opening day already exists
//            foreach ($openingday->getOpeninghours() as $openingType){
//                $startHour = $openinghourRepository->findOneByStarthour($openingType->getStarthour());
//                $endHour = $openinghourRepository->findOneByEndhour($openingType->getEndhour());
//                if($startHour){
//                    $openingday->removeOpeninghour($openingType);
//                    $openingday->addOpeninghour($openingType);
//                }
//                if($endHour){
//                    $openingday->removeOpeninghour($openingType);
//                    $openingday->addOpeninghour($openingType);
//                }
//            }
//
//            // Save the changes in the database
//            $managerRegistry->getManager()->persist($openingday);
//            $managerRegistry->getManager()->flush();
//        }
//
//        return $this->render('admin/admin_opening/createUpdate.html.twig', [
//            'openingDay' => $openingService->displayOpeningDays($openingdays),
//            'openingHour' => $openingService->displayOpeningHours($openinghours, $openingdays),
//            'restaurant' => $restaurant,
//
//            'openingdays' => $openingdays,
//            'openinghours' => $openinghours,
//            'isUpdated' =>  $isUpdated,
//            'form' => $form->createView(),
//        ]);
//    }


    /**
     * Update the opening hours of a day
     * @param Openingday $openingday
     * @param ManagerRegistry $managerRegistry
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param OpeningService $openingService
     * @param RestaurantRepository $restaurantRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/modification_horaires{id}', name: 'app_admin_updateOpening', methods: 'GET|POST')]
    public function updateOpening(Openingday $openingday, ManagerRegistry $managerRegistry, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, Request $request): Response
    {
        $openingdays = $openingdayRepository->findAll();
        $openinghours = $openinghourRepository->findAll();
        $isUpdated = true;

        $form = $this->createForm(OpeningdayType::class, $openingday);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Save the changes in the database
            $managerRegistry->getManager()->persist($openingday);
            $managerRegistry->getManager()->flush();
        }

        return $this->render('admin/admin_opening/createUpdate.html.twig', [
            'openingdays' => $openingdays,
            'openinghours' => $openinghours,
            'isUpdated' =>  $isUpdated,
            'form' => $form->createView(),
        ]);
    }


}
