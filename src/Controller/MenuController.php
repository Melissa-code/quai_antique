<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function index(): Response
    {
        $menus = ["Menu du jour", "Menu dégustation", "Menu burger", "Menu salade"];

        return $this->render('menu/menus.html.twig', [
            'menus' => $menus,
        ]);
    }
}
