<?php

namespace App\Service;

use App\Entity\Openingday;
use phpDocumentor\Reflection\Type;


class OpeningService
{
    /**
     * Return the opening days of the restaurant
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
     * Return the opening hours of the restaurant
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

    /**
     * Get the opening days with their opening hours
     * @param array $openingdays
     * @param array $openinghours
     * @return ?array
     */
    public function getDaysWithHours(array $openingdays, array $openinghours) : ?array
    {
        $daysWithHours = [];
        foreach ($openingdays as $openingday) {
            foreach ($openinghours as $openinghour) {
                foreach ($openingday->getOpeninghours() as $hourOfDay) {
                    if($hourOfDay->getId() === $openinghour->getId()) {
                        $daysWithHours[] .= $openingday->getDay();
                    }
                }
            }
        }
        return $daysWithHours;
    }

    /**
     * Get the days that are not in the array of the opening days
     * @param array $openingdays
     * @param array $daysWithHours
     * @return ?array
     */
    public function getNotFoundDaysInOpeningdays(array $openingdays, array $daysWithHours): ?array
    {
        $notFoundDays = [];
        foreach ($openingdays as $openingday) {
            if(!in_array($openingday->getDay(), $daysWithHours)) {
                $notFoundDays[] .= $openingday->getDay();
            }
        }
        return $notFoundDays;
    }

}