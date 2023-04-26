<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use App\Repository\RestaurantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminDishController extends AbstractController
{
    /**
     * Display the favorite dishes & the Create - Update - Delete buttons on the home page
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/admin/plats', name: 'app_admin_dish')]
    public function homeAdmin(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        return $this->render('home/home.html.twig', [
            'favoriteDishes' => $favoriteDishes,
            'admin' => true,
        ]);
    }

    /**
     * Create or Update a dish with a form
     * @param Dish|null $dish
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @param SluggerInterface $slugger
     * @param RestaurantRepository $restaurantRepository
     * @return Response
     */
    #[Route('/admin/creer_plat', name: 'app_admin_create_dish')]
    #[Route('/admin/modifier_plat{id}', name: 'app_admin_update_dish')]
    public function createOrUpdateDish(Dish $dish = null, Request $request, ManagerRegistry $managerRegistry, SluggerInterface $slugger, RestaurantRepository $restaurantRepository): Response
    {
        // If a dish doesn't exists, create a new object Dish
        if(!$dish) {
            $dish = new Dish();

            // Fill in the gap createdAt by the date of the day by default
            $date = new \DateTimeImmutable();
            $dish->setCreatedAt($date);
        }
        $isUpdated = $dish->getId() !== null;
        $restaurant = $restaurantRepository->findOneBy(array('name'=> "Le Quai Antique"));
        $dish->setRestaurant($restaurant);

        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $oldImage = $this->getParameter('directory_images_dishes').'/'.$dish->getImage();
            // Get the uploaded image file
            $imageFile = $form->get('imageFile')->getData();
            //Check if the image is valid
            if($imageFile) {
                $imageFileOriginal = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME );
                // Reformat the image file name to be conform to an URL
                $imageFileReformat = $slugger->slug($imageFileOriginal);
                // Create a unique name & unique id for the image file
                //$imageName = $imageFileReformat.'-'.uniqid().'-'.$imageFile->getExtension();
                $imageName = $imageFileReformat.'-'.uniqid().'-.png';
                // Move the image file to a specific directory in the server
                try {
                    $imageFile->move(
                        $this->getParameter('directory_images_dishes'),
                        $imageName
                    );
                } catch(FileException $e) {
                    throw $e;
                }
                // Save the name of the image file only
                $dish->setImage($imageName);

                if($isUpdated) {
                    // Delete the image file if it's updated
                    if(file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
            }

            // Save the changes in the database
            $managerRegistry->getManager()->persist($dish);
            $managerRegistry->getManager()->flush();

            // Display a success message
            $this->addFlash("success", ($isUpdated) ? "La modification a bien été effectuée." : "L'ajout a bien été effectué.");
        }

        return $this->render('admin/admin_dish/createUpdate.html.twig', [
            'form' => $form->createView(),
            'dish' => $dish,
            'isUpdated' => $isUpdated,
        ]);
    }

    /**
     * Delete a dish
     * @param Dish $dish
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @return Response
     */
    #[Route('/admin/supprimer_plat/{id}', name: 'app_admin_delete_dish', methods: 'DELETE')]
    public function delete(Dish $dish, Request $request, ManagerRegistry $managerRegistry) : Response
    {
        $image = $this->getParameter('directory_images_dishes').'/'.$dish->getImage();

        if($this->isCsrfTokenValid('REMOVE'.$dish->getId(), $request->get('_token')));

            // Delete the dish in the database
            $managerRegistry->getManager()->remove($dish);
            $managerRegistry->getManager()->flush();

            // Delete the image in the server
            if($image) {
                if(file_exists($image)) {
                    unlink($image);
                }
            }
            $this->addFlash("success", "La suppression a bien été effectuée.");
            return $this->redirectToRoute('app_admin_create_dish');
    }


}
