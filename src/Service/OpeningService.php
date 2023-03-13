<?php

namespace App\Service;

use App\Entity\Openingday;
use App\Entity\Openinghour;
use App\Repository\OpeningdayRepository;
use App\Repository\OpeninghourRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\HttpKernel\Log\format;

class OpeningService
{
    /**
     * Display the opening days of the restaurant
     * @param $openingdays
     * @return array
     */
    public function displayOpeningDays(array $openingdays): array{
        $days = [];

        foreach($openingdays as $openingday) {
            $days[] .= $openingday->getDay();
        }
        return $days;
    }

    /**
     * Display the opening hours of the restaurant
     * @param Openingday $day
     * @return mixed|string
     */
    public function displayOPeningHours(Openingday $day) {

        $hours = [];

        foreach ($day->getOpeninghours() as $hour) {
            $hours[] .= "{$hour->getStarthour()->format("H:i")} - {$hour->getEndhour()->format("H:i")} ";
        }
        if($hours) {
            if(count($hours) > 1) {
                $lastHour = end($hours);
                foreach ($hours as $hour) {
                    if($lastHour === $hour) {
                        return $hour . " ";
                    } else {
                        return $hour . " et ". $lastHour;
                    }
                }
            } else {
                foreach ($hours as $hour) {
                    return $hour ;
                }
            }
        } else {
            return "Fermé";
        }
    }



    /**
     * Display the opening hours of the restaurant
     * @param array $openinghours
     * @return array|string
     */
    public function displayHours(array $openinghours, array $openingdays): array|string
    {
        $startHours = [];
        $endHours = [];

        foreach($openinghours as $openinghour) {
            foreach($openingdays as $openingday) {
                foreach($openingday->getOpeninghours() as $day) {
                    if($day->getId() === $openinghour->getId()) {
                        $startHour = $openinghour->getStarthour();
                        // format() : display the Datetime to the format Hour & minutes (24 Hours)
                        $startHour = $startHour->format("H:i");
                        $endHour = $openinghour->getEndhour();
                        $endHour = $endHour->format("H:i");
                        // Save each $startHour & $endHour in the arrays $startHours[] & $endHours[]
                        $startHours[] .= $startHour;
                        $endHours[] .= $endHour;
                    } else {
                        $closed = "Fermé";
                    }
                }
            }
        }

        // array_unique() : Delete the duplicate values from the 2 arrays $startHours & $endHours
        $uniqueStartHours = array_unique($startHours);
        $noonStartHour = ($uniqueStartHours[0]);
        $eveningStartHour = ($uniqueStartHours[6]);

        $uniqueEndHours = array_unique($endHours);
        $noonEndHour = ($uniqueEndHours[0]);
        $eveningEndHour = ($uniqueEndHours[6]);
        $eveningSaturdayEndHour = ($uniqueEndHours[10]);

        $hours = [];
        $hours[] .= $noonStartHour ."-" . $noonEndHour;
        $hours[] .= $eveningStartHour ."-" . $eveningEndHour;
        $hours[] .= $eveningStartHour ."-" . $eveningSaturdayEndHour;
        $hours[] .= $closed;

        return $hours ;
    }





}