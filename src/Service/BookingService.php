<?php


namespace App\Service;


use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeZone;
use Exception;

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
     * Get the noon start time of a day
     * @param $hoursOfDay
     * @return string|null
     */
    public function getNoonStartTime($hoursOfDay): ?string
    {
        foreach ($hoursOfDay as $hour) {
            $startTime = $hour->getStarthour()->format('H:i:s');
            if (!empty($startTime) && $startTime < "17:00:00") {
                return $startTime;
            }
        }
        return null;
    }

    /**
     * Get the noon end time of a day
     * @param $hoursOfDay
     * @return string|null
     */
    public function getNoonEndTime($hoursOfDay): ?string
    {
        foreach ($hoursOfDay as $hour) {
            $endTime = $hour->getEndhour()->format('H:i:s');
            if(!empty($endTime) && $endTime < "17:00:00") {
                return $endTime;
            }
        }
        return null;
    }

    /**
     * Get the evening start time of a day
     * @param $hoursOfDay
     * @return string|null
     */
    public function getEveningStartTime($hoursOfDay): ?string
    {
        foreach ($hoursOfDay as $hour) {
            $startTime = $hour->getStarthour()->format('H:i:s');
            if(!empty($startTime) && $startTime > "17:00:00") {
                return $startTime;
            }
        }
        return null;
    }

    /**
     * Get the evening end time of a day
     * @param $hoursOfDay
     * @return string|null
     */
    public function getEveningEndTime($hoursOfDay): ?string
    {
        foreach ($hoursOfDay as $hour) {
            $endTime = $hour->getEndhour()->format('H:i:s');
            if(!empty($endTime) && $endTime > "17:00:00") {
                return $endTime;
            }
        }
        return null;
    }


    /**
     * Get an array of the hours with a 15 minutes time slot
     * @param string $startTime
     * @param $endTime
     * @return ?array
     * @throws Exception
     */
    public function getHoursBySlice(string $startTime, $endTime): ?array
    {
        $hours = [];
        $start = new DateTime($startTime, new DateTimeZone('Europe/Paris'));
        $end = new DateTime($endTime, new DateTimeZone('Europe/Paris'));
        // Create an interval of 45 minutes to have the last hour of a booking : one hour before the end
        $interval = new DateInterval('PT45M');
        $endBooking = date_sub($end, $interval);
        foreach (new DatePeriod($start, new DateInterval('PT15M'), $endBooking) as $dt) {
            $dt = $dt->format('H:i');
            $hours[] .= $dt;
        }
        return($hours);
    }




}