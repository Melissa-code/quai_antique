<?php


namespace App\Service;


class BookingService
{
    /** Translate an english day to french
     * @param $day
     * @return string
     */
    public function translateToFrench(string $day): string {
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

}