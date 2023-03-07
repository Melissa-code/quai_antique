<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Daytime;
use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\Openingday;
use App\Entity\Openinghour;
use App\Entity\Restaurant;
use App\Entity\Setmenu;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\TimeImmutableType;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    //public const RESTAURANT_REFERENCE = 6;

    public function load(ObjectManager $manager): void
    {
        /** *****************************************/
        //             Dishes
        /****************************************** */

        /*********** Restaurant **********/

        // Data example for restaurants
        $r1 = new Restaurant();
        $r1->setName("Le Quai Antique")
            ->setAddress("5 Quai du Jeu de Paume")
            ->setZipcode("73 000")
            ->setCity("Chambéry")
            ->setPhone("+33(0)4 79 60 26 26")
            ->setEmail("quai-antique@infos-restaurant.com")
            ->setNbseatings(60);
        $manager->persist($r1);

        /*********** Categories **********/

        // Data example for categories
//        $c1 = new Category();
//        $c1->setTitle("entrées")
//            ->setImage("starters.png");
//        $manager->persist($c1);

//        $c2 = new Category();
//        $c2->setTitle("plats")
//            ->setImage("dishes.png");
//        $manager->persist($c2);
//
//        $c3 = new Category();
//        $c3->setTitle("desserts")
//            ->setImage("desserts.png");
//        $manager->persist($c3);
//
//        $c4 = new Category();
//        $c4->setTitle("burgers")
//            ->setImage("burgers.png");
//        $manager->persist($c4);
//
//        $c5 = new Category();
//        $c5->setTitle("salades")
//            ->setImage("salads.png");
//        $manager->persist($c5);

        /*********** Dishes **********/

        // Data example for dishes
//            $d1 = new Dish();
//            $d1->setTitle("Carpaccio de pamplemousse")
//                ->setPrice(mt_rand(7, 10))
//                ->setDescription("(Pamplemousses, fenouil, jeunes pousses)")
//                ->setImage("uploads/carpaccio.png")
//                ->setCreatedAt(new \DateTimeImmutable('now'))
//                ->setFavorite(mt_rand(0, 1))
//                ->setActive(1)
//                ->setRestaurant($r1)
//                ->setCategory($c1);
//            $manager->persist($d1);


//        for ($i = 0; $i < 4; $i++) {
//            $d2 = new Dish();
//            $d2->setTitle("Fondue pétillante de Savoie")
//                ->setPrice(mt_rand(15, 20))
//                ->setDescription("(Beaufort, emmental de Savoie, abondance)")
//                ->setImage("uploads/fondue.png")
//                ->setCreatedAt(new \DateTimeImmutable('now'))
//                ->setFavorite(mt_rand(0, 1))
//                ->setActive(1)
//                ->setRestaurant($r1)
//                ->setCategory($c2);
//            $manager->persist($d2);
//        }

//        for ($i = 0; $i < 4; $i++) {
//            $d3 = new Dish();
//            $d3->setTitle("Gâteau de Savoie")
//                ->setPrice(mt_rand(9, 12))
//                ->setDescription("(Framboises, gâteau de Savoie)")
//                ->setImage("uploads/gateau-savoie.png")
//                ->setCreatedAt(new \DateTimeImmutable('now'))
//                ->setFavorite(mt_rand(0, 1))
//                ->setActive(1)
//                ->setRestaurant($r1)
//                ->setCategory($c3);
//            $manager->persist($d3);
//        }

//        for ($i = 0; $i < 4; $i++) {
//            $d4 = new Dish();
//            $d4->setTitle("L'original")
//                ->setPrice(mt_rand(15, 18))
//                ->setDescription("(Steak, cheddar, salade, tomate, sauce barbecue)")
//                ->setImage("uploads/original.png")
//                ->setCreatedAt(new \DateTimeImmutable('now'))
//                ->setFavorite(mt_rand(0, 1))
//                ->setActive(1)
//                ->setRestaurant($r1)
//                ->setCategory($c4);
//            $manager->persist($d4);
//        }

//        for ($i = 0; $i < 4; $i++) {
//            $d5 = new Dish();
//            $d5->setTitle("Salade César au beaufort")
//                ->setPrice(mt_rand(16, 18))
//                ->setDescription("(Salade, poulet, croûtons, beaufort, parmesan)")
//                ->setImage("uploads/cesar.png")
//                ->setCreatedAt(new \DateTimeImmutable('now'))
//                ->setFavorite(mt_rand(0, 1))
//                ->setActive(1)
//                ->setRestaurant($r1)
//                ->setCategory($c5);
//            $manager->persist($d5);
//        }


        /** *****************************************/
        //              Menus
        /****************************************** */

        /*********** Day time : noon / evening **********/

//        // Data example for daytime
//        $dt1 = new Daytime();
//        $dt1->setTitle("Midi");
//        $manager->persist($dt1);
//
//        $dt2 = new Daytime();
//        $dt2->setTitle("Soir");
//        $manager->persist($dt2);
//
        /*********** Menus **********/

//        // Data example for menu
//        $m1 = new Menu();
//        $m1->setTitle("Menu du jour")
//            ->setActive(1)
//            ->addDaytime($dt1);
//        $manager->persist($m1);
//
//        $m2 = new Menu();
//        $m2->setTitle("Menu dégustation")
//            ->setActive(1)
//            ->addDaytime($dt2);
//        $manager->persist($m2);
//
//        $m3 = new Menu();
//        $m3->setTitle("Menu burger")
//            ->setActive(1)
//            ->addDaytime($dt1)
//            ->addDaytime($dt2);
//        $manager->persist($m3);
//
//        $m4 = new Menu();
//        $m4->setTitle("Menu salade")
//            ->setActive(1)
//            ->addDaytime($dt1)
//            ->addDaytime($dt2);
//        $manager->persist($m4);
//
        /*********** Setmenus **********/

//        // Data example for setmenu
//        $sm1 = new Setmenu();
//        $sm1->setTitle("Formule du jour légère")
//            ->setActive(1)
//            ->setShortdesc("Le midi du lundi au vendredi")
//            ->setDescription("Entrée + Plat ou Plat + Dessert")
//            ->setPrice(20)
//            ->setMenu($m1)
//            // ->addDish($d1)
//            ;
//        $manager->persist($sm1);
//
//        $sm2 = new Setmenu();
//        $sm2->setTitle("Formule du jour complète")
//            ->setActive(1)
//            ->setShortdesc("Le midi du lundi au samedi")
//            ->setDescription("Entrée + Plat + Dessert")
//            ->setPrice(26)
//            ->setMenu($m1)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm2);
//
//        $sm3 = new Setmenu();
//        $sm3->setTitle("Formule dégustation légère")
//            ->setActive(1)
//            ->setShortdesc("Le soir du lundi au vendredi")
//            ->setDescription("Entrée + Plat ou Plat + Dessert")
//            ->setPrice(27)
//            ->setMenu($m2)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm3);
//
//        $sm4 = new Setmenu();
//        $sm4->setTitle("Formule dégustation complète")
//            ->setActive(1)
//            ->setShortdesc("Le soir du lundi au samedi")
//            ->setDescription("Entrée + Plat + Dessert")
//            ->setPrice(35)
//            ->setMenu($m2)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm4);
//
//        $sm5 = new Setmenu();
//        $sm5->setTitle("Formule burger légère")
//            ->setActive(1)
//            ->setShortdesc("Le soir et midi du lundi au vendredi")
//            ->setDescription("Entrée + Plat ou Plat + Dessert")
//            ->setPrice(18)
//            ->setMenu($m3)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm5);
//
//        $sm6 = new Setmenu();
//        $sm6->setTitle("Formule burger complète")
//            ->setActive(1)
//            ->setShortdesc("Le soir et midi du lundi au samedi")
//            ->setDescription("Entrée + Plat + Dessert")
//            ->setPrice(24)
//            ->setMenu($m3)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm6);
//
//        $sm7 = new Setmenu();
//        $sm7->setTitle("Formule salade légère")
//            ->setActive(1)
//            ->setShortdesc("Le soir et midi du lundi au vendredi")
//            ->setDescription("Entrée + Plat ou Plat + Dessert")
//            ->setPrice(19)
//            ->setMenu($m4)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm7);
//
//        $sm8 = new Setmenu();
//        $sm8->setTitle("Formule salade complète")
//            ->setActive(1)
//            ->setShortdesc("Le soir et midi du lundi au samedi")
//            ->setDescription("Entrée + Plat + Dessert")
//            ->setPrice(25)
//            ->setMenu($m4)
//            // ->addDish($d1)
//        ;
//        $manager->persist($sm8);


        /** *****************************************/
        //              Opening
        /****************************************** */

        /*********** Opening days **********/

        $od1 = new Openingday();
        $od1->setDay("lundi")
            ->setOpen(1)
            ->setRestaurant($r1)
            ;
        $manager->persist($od1);

        $od2 = new Openingday();
        $od2->setDay("mardi")
            ->setOpen(1)
            ->setRestaurant($r1)
            ;
        $manager->persist($od2);

        $od3 = new Openingday();
        $od3->setDay("mercredi")
            ->setOpen(0)
            ->setRestaurant($r1)
            ;
        $manager->persist($od3);

        $od4 = new Openingday();
        $od4->setDay("jeudi")
            ->setOpen(1)
            ->setRestaurant($r1)
            ;
        $manager->persist($od4);

        $od5 = new Openingday();
        $od5->setDay("vendredi")
            ->setOpen(1)
            ->setRestaurant($r1)
            ;
        $manager->persist($od5);

        $od6 = new Openingday();
        $od6->setDay("samedi")
            ->setOpen(1)
            ->setRestaurant($r1)
            ;
        $manager->persist($od6);

        $od7 = new Openingday();
        $od7->setDay("dimanche")
            ->setOpen(1)
            ->setRestaurant($r1)
            ;
        $manager->persist($od7);


        /*********** Opening hours **********/

        $h1 = new \DateTime("12:00:00");
        $h2 = new \DateTime("14:00:00");
        $h3 = new \DateTime("19:00:00");
        $h4 = new \DateTime("22:00:00");
        $h5 = new \DateTime("23:00:00");

        $oh1 = new Openinghour();
        $oh1->setStarthour($h1)
            ->setEndhour($h2)
            ->addOpeningday($od1)
            ->addOpeningday($od2)
            ->addOpeningday($od4)
            ->addOpeningday($od5)
            ->addOpeningday($od7)
            ;
        $manager->persist($oh1);

        $oh2 = new Openinghour();
        $oh2->setStarthour($h3)
            ->setEndhour($h4)
            ->addOpeningday($od1)
            ->addOpeningday($od2)
            ->addOpeningday($od4)
            ->addOpeningday($od5)
        ;
        $manager->persist($oh2);

        $oh3 = new Openinghour();
        $oh3->setStarthour($h3)
            ->setEndhour($h5)
            ->addOpeningday($od6)
        ;
        $manager->persist($oh3);


        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}
