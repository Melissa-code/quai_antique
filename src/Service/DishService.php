<?php

namespace App\Service;

class DishService
{
    public function displayDishes($categories, $dishes): string {
        $result = "";
        foreach($categories as $category) {
            foreach ($dishes as $dish) {
                if($category->getId() === $dish->getCategory()->getId()) {
                    //echo '<b>'.$dish->getTitle().'</b> - '.$dish->getPrice() .' € <br/>'.$dish->getDescription().'<br/><br/>';
                   $result .= $dish->getTitle();
                }
            }
        }
        return $result;
    }


}

