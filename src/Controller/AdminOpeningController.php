<?php

namespace App\Controller;


use App\Entity\Openingday;
use App\Entity\Openinghour;
use App\Form\OpeningdayType;
use App\Form\OpeninghourType;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/horaires_ouverture', name: 'app_admin_opening')]
    public function openingDaysHours(OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $openinghours = $openinghourRepository->findAll();
        $openingdays = $openingdayRepository->findAll();
        $closed = "Fermé";

        // Pagination (4 days per page) : $hours replace $openinghours = $openinghourRepository->findAll();
        $hours = $paginator->paginate(
            $openinghourRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            4 /* limit per page */
        );

        return $this->render('admin/admin_opening/openingHours.html.twig', [
            'openinghours' => $hours,
            'closed' => $closed,
            'openingdays' => $openingdays,
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
     * Create or Update the opening hours of a day
     * @param Openinghour|null $openinghour
     * @param ManagerRegistry $managerRegistry
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/creation_horaire', name: 'app_admin_create_openingHours')]
    #[Route('/admin/modification_horaire{id}', name: 'app_admin_update_openingHours', methods: 'GET|POST')]
    public function createOrUpdateOpeningHours(Openinghour $openinghour = null, ManagerRegistry $managerRegistry, Request $request): Response
    {
        if(!$openinghour) {
            $openinghour = new Openinghour();
        }
        $isUpdated = $openinghour->getId() !== null;

        $form = $this->createForm(OpeninghourType::class, $openinghour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Save the changes in the database
            $managerRegistry->getManager()->persist($openinghour);
            $managerRegistry->getManager()->flush();

            // Display a success message
            $this->addFlash("success", ($isUpdated) ? "La modification a bien été effectuée." : "L'ajout a bien été effectué.");
            return $this->redirectToRoute('app_admin_opening');
        }

        return $this->render('admin/admin_opening/createUpdateHours.html.twig', [
            'isUpdated' =>  $isUpdated,
            'openinghour' => $openinghour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete the opening hours of a day
     * @param Openinghour $openinghour
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @return Response
     */
    #[Route('/admin/supprimer_horaire/{id}', name: 'app_admin_delete_openingHours', methods: 'DELETE')]
    public function delete(Openinghour $openinghour, Request $request, ManagerRegistry $managerRegistry) : Response
    {
        if($this->isCsrfTokenValid("remove".$openinghour->getId(), $request->get("_token"))) {
            // Delete the hours in the database
            $managerRegistry->getManager()->remove($openinghour);
            $managerRegistry->getManager()->flush();

            $this->addFlash("success", "La suppression a bien été effectuée.");
            return $this->redirectToRoute('app_admin_opening');
        }
    }


}
