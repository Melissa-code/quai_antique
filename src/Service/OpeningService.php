<?php

namespace App\Service;

use App\Entity\Openingday;
use App\Entity\Openinghour;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;


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
                $lastHour = end($hours);
                foreach ($hours as $hour) {
                    if($hour === $lastHour) {
                        return $hour ." ";
                    } else {
                        return $hour ." et ".$lastHour;
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