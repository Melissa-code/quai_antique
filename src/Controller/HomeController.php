<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Get and display the favorite dishes in the photos gallery of the home page
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        // Redirect to the HTTPS protocol of Heroku if it is http
        // $word = "herokuapp.com";
        // $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        //if(strpos($url, $word)) {
            //header('Location:https://le-quai-antique-restaurant.herokuapp.com/');
            //exit();
            //echo "<script> window.location ='https://le-quai-antique-restaurant.herokuapp.com/'</script>";
            //return $this->redirect('https://le-quai-antique-restaurant.herokuapp.com/');
        //}

        return $this->render('home/home.html.twig', [
            'favoriteDishes' => $favoriteDishes,
            'admin' => false,
            ]);
    }

}
