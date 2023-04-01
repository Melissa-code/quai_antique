<?php

namespace App\Controller;

use App\Repository\OpeningdayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpeningdayController extends AbstractController
{
    /**
     * Put each day with its hours in an array
     * and return the response is in a JSON format
     * @param OpeningdayRepository $openingdayRepository
     * @return Response
     */
    #[Route('/openingdays', name: 'app_openingdays')]
    public function readOpeningdays(OpeningdayRepository $openingdayRepository): Response
    {
        $openingdays = $openingdayRepository->findAll();
        $arrayOfDays = [];

        foreach($openingdays as $openingday) {
            $arrayOfDays[] = $openingday->toArray();
        }
        return $this->json($arrayOfDays);
    }
}
