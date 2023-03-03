<?php


namespace App\Service;


class MenuService
{

//    public function displaySetmenuStarters(array $menus, array $startersMenu1, array $startersMenu2, array $startersMenu3): array
//    {
//        $result = [];
//
//        foreach ($menus as $menu) {
//            switch ($menu) {
//                case $menu->getId() === 1:
//                    foreach ($startersMenu1 as $starterMenu1) {
//                        $result[] = $starterMenu1->getTitle();
//
//                    }
//                    break;
//                case $menu->getId() === 2:
//                    foreach ($startersMenu2 as $starterMenu2) {
//                        $result[] = $starterMenu2->getTitle();
//
//                    }
//                    break;
//                case $menu->getId() === 3:
//                    foreach ($startersMenu3 as $starterMenu3) {
//                        $result[] = $starterMenu3->getTitle();
//
//                    }
//                    break;
//            }
//            return $result;
//        }
//    }


    public function displaySetmenuStarters(array $menus, array $startersMenu1, array $startersMenu2, array $startersMenu3): string
    {
        $result = "";

        foreach ($menus as $menu) {
            if ($menu->getId() === 1) {
                foreach ($startersMenu1 as $starterMenu1) {
                    $result .= '- '.$starterMenu1->getTitle();
                }
            } else if ($menu->getId() === 2) {
                foreach ($startersMenu2 as $starterMenu2) {
                    $result .= '- '.$starterMenu2->getTitle();
                }
            } else if ($menu->getId() === 3) {
                foreach ($startersMenu3 as $starterMenu3) {
                    $result .= '- '.$starterMenu3->getTitle();
                }
            }
        }
        return $result;
    }


    public function displayStartersMenu1(array $startersMenu1): string
    {
        $result = "";
        foreach ($startersMenu1 as $starterMenu1) {
            //$result .= sprintf('- %s ', $starterMenu1->getTitle());
            $result .=  "- {$starterMenu1->getTitle()}";

        }
        return $result;
    }


}