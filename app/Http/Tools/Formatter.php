<?php

namespace App\Http\Tools;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class Formatter
{
    private $charactersToFormat;

    public function __construct($charactersToFormat = [])
    {
        $this->charactersToFormat = (count($charactersToFormat) > 0) ? $charactersToFormat : $this->charactersToFormat;
    }

    public function newOrderId($articleId = "", $currentUser = true)
    {
        return $articleId . '_' . (($currentUser) ? Auth::user()->username : $currentUser) . '_' . $this->getTime();
    }

    public function getTime($addTime = '0 days', $timeZone = 'America/Bogota', $format = 'Y-m-d_H-i-s')
    {
        $date = new DateTime("now", new DateTimeZone($timeZone));
        $date->add(date_interval_create_from_date_string($addTime));
        return $date->format($format);
    }
}
