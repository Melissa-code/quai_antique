<?php


namespace App\Service;


use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeZone;

class BookingService
{
    /**
     * Translate an english day to french
     * @param $day
     * @return string
     */
    public function translateToFrench(string $day): string
    {
        switch ($day){
            case "Mon":
                return "lundi";
            case "Tue":
                return "mardi";
            case "Wed":
                return "mercredi";
            case "Thu":
                return "jeudi";
            case "Fri":
                return "vendredi";
            case "Sat":
                return "samedi";
            case "Sun":
                return "dimanche";
        }
    }

    /**
     * Get an array of the hours with a 15 minutes time slot
     * @param string $startTime
     * @param $endTime
     * @return array
     * @throws \Exception
     */
    public function getHoursBySlice(string $startTime, $endTime): array
    {
        $hours = [];
        $start = new DateTime($startTime, new DateTimeZone('Europe/Paris'));
        $end = new DateTime($endTime, new DateTimeZone('Europe/Paris'));
        foreach (new DatePeriod($start, new DateInterval('PT15M'), $end) as $dt) {
            $dt = $dt->format('H:i');
            $hours[] .= $dt;
        }
        return($hours);
    }

    /**
     * Get the noon start time of a day
     * @param $hoursOfDay
     * @return string
     */
    public function getNoonStartTime($hoursOfDay): string
    {
        foreach ($hoursOfDay as $hour) {
            $startTime = $hour->getStarthour()->format('H:i:s');
            if (!empty($startTime) && $startTime < "17:00:00") {
                return $startTime;
            }
        }
    }

    /**
     * Get the noon end time of a day
     * @param $hoursOfDay
     * @return string
     */
    public function getNoonEndTime($hoursOfDay): string
    {
        foreach ($hoursOfDay as $hour) {
            $endTime = $hour->getEndhour()->format('H:i:s');
            if(!empty($endTime) && $endTime < "17:00:00") {
                return $endTime;
            }
        }
    }

    /**
     * Get the evening start time of a day
     * @param $hoursOfDay
     * @return string
     */
    public function getEveningStartTime($hoursOfDay): string
    {
        foreach ($hoursOfDay as $hour) {
            $startTime = $hour->getStarthour()->format('H:i:s');
            if(!empty($startTime) && $startTime > "17:00:00") {
                return $startTime;
            }
        }
    }

    /**
     * Get the evening end time of a day
     * @param $hoursOfDay
     * @return string
     */
    public function getEveningEndTime($hoursOfDay): string
    {
        foreach ($hoursOfDay as $hour) {
            $endTime = $hour->getEndhour()->format('H:i:s');
            if(!empty($endTime) && $endTime > "17:00:00") {
                return $endTime;
            }
        }
    }


}