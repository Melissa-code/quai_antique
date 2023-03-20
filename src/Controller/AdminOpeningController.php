<?php

namespace App\Controller;


use App\Entity\Openinghour;
use App\Form\OpeninghourType;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
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
     * @param OpeningService $openingService
     * @param OpeningdayRepository $openingdayRepository
     * @param OpeninghourRepository $openinghourRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/horaires_ouverture', name: 'app_admin_opening')]
    public function openingHours(OpeningService $openingService, OpeningdayRepository $openingdayRepository, OpeninghourRepository $openinghourRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $findAllByAscendingHours = $openinghourRepository->findAllByAscendingHours();
        $openinghours = $openinghourRepository->findAll();
        $openingdays = $openingdayRepository->findAll();
        $closed = "Fermé";

        // Change the attribute open of a day: false to true if the day get opening hours
        foreach ($openingdays as $openingday) {
            foreach ($openinghours as $openinghour) {
                foreach ($openingday->getOpeninghours() as $hourOfDay) {
                    if($hourOfDay->getId() === $openinghour->getId() && $openingday->isOpen() === false) {
                        //echo $openingday->getDay();
                        $openingdayRepository->updateOpen(1, $openingday->getId());
                        $openingday->setOpen(true);
                    }
                }
            }
        }

        // Change the attribute open of a day: true to false if it doesn't have any opening hours
        $daysWithHours = $openingService->getDaysWithHours($openingdays, $openinghours);
        $notFoundDays = $openingService->getNotFoundDaysInOpeningdays($openingdays, $daysWithHours);
        foreach ($openingdays as $openingday) {
            foreach ($notFoundDays as $notFoundDay) {
                if($openingday->getDay() === $notFoundDay) {
                    //echo $notFoundDay;
                    $openingdayRepository->updateOpen(0, $openingday->getId());
                    $openingday->setOpen(false);
                }
            }
        }

        // Pagination (4 hours a page) : $hours replaces $openinghours = $openinghourRepository->findAll();
        $ascendingOpeninghours = $paginator->paginate(
            $openinghourRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            4 /* limit per page */
        );

        return $this->render('admin/admin_opening/openingHours.html.twig', [
            'closed' => $closed,
            'openingdays' => $openingdays,
            'ascendingOpeninghours'=> $ascendingOpeninghours
        ]);
    }

    /**
     * Create or Update the opening hours of a day
     * @param Openinghour|null $openinghour
     * @param ManagerRegistry $managerRegistry
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/creation_horaire', name: 'app_admin_create_openingHours')]
    #[Route('/admin/modification_horaire/{id}', name: 'app_admin_update_openingHours', methods: 'GET|POST')]
    public function createOrUpdateOpeningHours(Openinghour $openinghour = null, ManagerRegistry $managerRegistry, Request $request): Response
    {
        if(!$openinghour) {
            $openinghour = new Openinghour();
        }
        $isUpdated = $openinghour->getId() !== null;

        $form = $this->createForm(OpeninghourType::class, $openinghour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $managerRegistry->getManager()->persist($openinghour);
            $managerRegistry->getManager()->flush();
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
            $managerRegistry->getManager()->remove($openinghour);
            $managerRegistry->getManager()->flush();
            $this->addFlash("success", "La suppression a bien été effectuée.");
            return $this->redirectToRoute('app_admin_opening');
        }
    }


}
