<?php

namespace App\Controller;


use App\Repository\DaytimeRepository;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function menu(DaytimeRepository $daytimeRepository, MenuRepository $menuRepository): Response
    {
        $menus = $menuRepository->findAll();
        $daytimes = $daytimeRepository->findAll();

        return $this->render('menu/menus.html.twig', [
            'menus' => $menus,
            'daytimes'=> $daytimes,

        ]);
    }
}
