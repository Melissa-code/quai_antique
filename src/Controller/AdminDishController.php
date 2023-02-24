<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
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
     * Display the add update & delete buttons on the home page
     * @param DishRepository $dishRepository
     * @return Response
     */
    #[Route('/admin/plats', name: 'app_admin_dish')]
    public function homeAdmin(DishRepository $dishRepository): Response
    {
        $favoriteDishes = $dishRepository->findFavoriteDishes(6);

        return $this->render('home/home.html.twig', [
            "favoriteDishes" => $favoriteDishes,
            "admin" => true,
        ]);
    }

    /**
     * Update a dish form
     * @param Dish|null $dish
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @param SluggerInterface $slugger
     * @return Response
     */
    #[Route('/admin/creer_plat', name: 'app_admin_create_dish')]
    #[Route('/admin/modifier_plat{id}', name: 'app_admin_update_dish')]
    public function updateDish(Dish $dish = null, Request $request, ManagerRegistry $managerRegistry, SluggerInterface $slugger): Response
    {
        // If a dish doesn't exists, create a new object Dish
        if(!$dish) {
            $dish = new Dish();

            // Fill in the gap createdAt by the date of the day by default
            $date = new \DateTimeImmutable();
            $dish->setCreatedAt($date);
        }

        $isUpdated = $dish->getId() !== null;

//        if($isUpdated) {
//            $oldImage = $this->getParameter('directory_images_dishes').'/'.$dish->getImage();
//            //dd($oldImage);
//        }

        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $oldImage = $this->getParameter('directory_images_dishes').'/'.$dish->getImage();
            //dd($oldImage);

            // Get the uploaded image file
            $imageFile = $form->get('imageFile')->getData();
            //Check if the image is valid
            if($imageFile) {
                $imageFileOriginal = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME );
                // Reformat the image file name to be conform to an URL
                $imageFileReformat = $slugger->slug($imageFileOriginal);
                // Create a unique name & unique id for the image file
                $imageName = $imageFileReformat.'-'.uniqid().'-'.$imageFile->getExtension();
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


                // Delete the image file if it's updated
                if(file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // Save the changes in the database
            $managerRegistry->getManager()->persist($dish);
            $managerRegistry->getManager()->flush();

            // Delete the image file if it's updated
//            if($isUpdated){
//                if(file_exists($oldImage) ) {
//                    unlink($oldImage);
//                }
//            }

            // Display a success message
            $this->addFlash("success", ($isUpdated) ? "La modification a bien été effectuée." : "L'ajout a bien été effectué.");
            //return $this->redirectToRoute('app_admin_dish');

        }

        return $this->render('admin_dish/update.html.twig', [
            "form" => $form->createView(),
            "dish" => $dish,
            "isUpdated" => $isUpdated,
        ]);
    }


}
