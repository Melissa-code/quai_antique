<?php

namespace App\Service;

use App\Entity\Openingday;


class OpeningService
{
    /**
     * Display the opening days of the restaurant
     * @param $openingdays
     * @return array
     */
    public function displayOpeningDays(array $openingdays): array
    {
        $days = [];

        foreach($openingdays as $openingday) {
            $days[] .= $openingday->getDay();
        }
        return $days;
    }


    /**
     * Display the opening hours of the restaurant
     * @param Openingday $day
     * @return mixed
     */
    public function displayOpeningHours(Openingday $day): mixed
    {
        $hours = [];
        foreach ($day->getOpeninghours() as $hour) {
            $hours[] .= "{$hour->getStarthour()->format("H:i")} - {$hour->getEndhour()->format("H:i")} ";
        }
        if($hours) {
            if(count($hours) > 1) {
                $firstHour = reset($hours);
                $lastHour = end($hours);
                if($lastHour < 17 && $lastHour < $firstHour) {
                    $hours = array_reverse($hours);
                }
                foreach ($hours as $hour) {
                    if($hour === end($hours)) {
                        return $hour ." ";
                    } else {
                        return $hour ." et ".end($hours);
                    }
                }
            } else {
                foreach ($hours as $hour) {
                    return $hour;
                }
            }
        } else {
            return "Fermé";
        }
    }




}