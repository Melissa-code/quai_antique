<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    #[Route('/la_carte', name: 'app_food')]
    public function index()
    {
        $categories = ["Nos Entrées", "Nos Plats", "Nos Desserts", "Nos Burgers", "Nos Salades"];

        $dishes = [
            "dish1" => [
                "name" =>  "Carpaccio de pamplemousses",
                "price" => 7,
                "desc" => "(Pamplemousses, fenouil, jeunes pousses)",
                "category" => "Nos Entrées"
            ],
            "dish2" => [
                "name" =>  "Croûte savoyarde",
                "price" => 8,
                "desc" => "(Jambon de Savoie, artichaut, tapenade, toasts)",
                "category" => "Nos Entrées"
            ],
            "dish3" => [
                "name" =>  "Fondue pétillante de Savoie",
                "price" => 15,
                "desc" => "(Beaufort, emmental de Savoie, abondance)",
                "category" => "Nos Plats"
            ],
            "dish4" => [
                "name" =>  "Gâteau de Savoie",
                "price" => 9,
                "desc" => "(Framboises, gâteau de Savoie)",
                "category" => "Nos Desserts"
            ],
            "dish5" => [
                "name" =>  "L’original",
                "price" => 15,
                "desc" => "(Steak, cheddar, salade, tomate,  sauce barbecue)",
                "category" => "Nos Burgers"
            ],
            "dish6" => [
                "name" =>  "Salade  César au Beaufort",
                "price" => 16,
                "desc" => "Salade, poulet, parmesan)",
                "category" => "Nos Salades"
            ],

        ];


        return $this->render('food/food.html.twig', [
            'categories' => $categories,
            'dishes' => $dishes
        ]);
    }
}
