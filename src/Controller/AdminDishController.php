<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDishController extends AbstractController
{
    #[Route('/admin/plats', name: 'app_admin_dish')]
    public function index(): Response
    {
        return $this->render('admin_dish/dish.html.twig', [

        ]);
    }
}
