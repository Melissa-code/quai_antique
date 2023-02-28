<?php

namespace App\Controller;


use App\Repository\DaytimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function menu(DaytimeRepository $daytimeRepository): Response
    {
        $menus = ["Menu du jour", "Menu dégustation", "Menu burger", "Menu salade"];

        $daytimes = $daytimeRepository->findAll();

        return $this->render('menu/menus.html.twig', [
            'menus' => $menus,
            'daytimes'=> $daytimes,

        ]);
    }
}
