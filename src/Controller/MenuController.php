<?php

namespace App\Controller;


use App\Repository\DaytimeRepository;
use App\Repository\MenuRepository;
use App\Repository\SetmenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function menu(DaytimeRepository $daytimeRepository, MenuRepository $menuRepository, SetmenuRepository $setmenuRepository): Response
    {
        $menus = $menuRepository->findAll();
        $daytimes = $daytimeRepository->findAll();
        $setmenus = $setmenuRepository->findAll();



        return $this->render('menu/menus.html.twig', [
            'menus' => $menus,
            'daytimes'=> $daytimes,
            'setmenus' => $setmenus,


        ]);
    }
}
