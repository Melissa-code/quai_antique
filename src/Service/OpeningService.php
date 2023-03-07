<?php


namespace App\Service;


use DateTime;

class OpeningService
{
    /** Display the opening days of the restaurant
     * @param $openingdays
     * @return array
     */
    public function displayOpeningDays($openingdays){

        $result = [];

        foreach($openingdays as $openingday) {
            $result[] .= $openingday->getDay();
        }
        return $result;
    }



}