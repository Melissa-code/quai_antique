<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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

        // Data example for categories
        $c1 = new Category();
        $c1->setTitle("entrées")
            ->setImage("starters/ham.png");
        $manager->persist($c1);

        $c2 = new Category();
        $c2->setTitle("plats")
            ->setImage("dishes/tartiflette.png");
        $manager->persist($c2);

        $c3 = new Category();
        $c3->setTitle("desserts")
            ->setImage("desserts/flan.png");
        $manager->persist($c3);

        $c4 = new Category();
        $c4->setTitle("burgers")
            ->setImage("burgers/original.png");
        $manager->persist($c4);

        $c5 = new Category();
        $c5->setTitle("salades")
            ->setImage("salads/poke-salad.png");
        $manager->persist($c5);

        // Data example for dishes
        for ($i = 0; $i < 4; $i++) {
            $d1 = new Dish();
            $d1->setTitle("Carpaccio de pamplemousse".$i)
                ->setPrice(mt_rand(7, 10))
                ->setDescription("(Pamplemousses, fenouil, jeunes pousses)")
                ->setImage("starters/carpaccio.png")
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setFavorite(mt_rand(0, 1))
                ->setActive(1)
                ->setRestaurant($r1)
                ->setCategory($c1);
            $manager->persist($d1);
        }

        for ($i = 0; $i < 4; $i++) {
            $d2 = new Dish();
            $d2->setTitle("Fondue pétillante de Savoie")
                ->setPrice(mt_rand(15, 20))
                ->setDescription("(Beaufort, emmental de Savoie, abondance)")
                ->setImage("dishes/fondue.png")
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setFavorite(mt_rand(0, 1))
                ->setActive(1)
                ->setRestaurant($r1)
                ->setCategory($c2);
            $manager->persist($d2);
        }

        for ($i = 0; $i < 4; $i++) {
            $d3 = new Dish();
            $d3->setTitle("Gâteau de Savoie")
                ->setPrice(mt_rand(9, 12))
                ->setDescription("(Framboises, gâteau de Savoie)")
                ->setImage("desserts/gateau-savoie.png")
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setFavorite(mt_rand(0, 1))
                ->setActive(1)
                ->setRestaurant($r1)
                ->setCategory($c3);
            $manager->persist($d3);
        }

        for ($i = 0; $i < 4; $i++) {
            $d4 = new Dish();
            $d4->setTitle("L'original")
                ->setPrice(mt_rand(15, 18))
                ->setDescription("(Steak, cheddar, salade, tomate, sauce barbecue)")
                ->setImage("burgers/originaal.png")
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setFavorite(mt_rand(0, 1))
                ->setActive(1)
                ->setRestaurant($r1)
                ->setCategory($c4);
            $manager->persist($d4);
        }

        for ($i = 0; $i < 4; $i++) {
            $d5 = new Dish();
            $d5->setTitle("Salade César au Beaufort")
                ->setPrice(mt_rand(16, 18))
                ->setDescription("(Salade, poulet, croutons, beaufort)")
                ->setImage("desserts/gateau-savoie")
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setFavorite(mt_rand(0, 1))
                ->setActive(1)
                ->setRestaurant($r1)
                ->setCategory($c5);
            $manager->persist($d5);
        }

        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}
