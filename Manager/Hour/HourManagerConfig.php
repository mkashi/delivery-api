<?php

namespace Delivery\ApiBundle\Manager\Hour;

/**
 * Class HourManagerConfig
 */
class HourManagerConfig implements HourManagerInterface
{
    /**
     * @var array [{start, end}]
     * @example [{'20:00', '05:00'}, {'22:00', '04:00'}, {'20:00', '05:00'}]
     */
    private $hours;

    /**
     * @var \DateTime
     */
    private $startHour;

    /**
     * @var \DateTime
     */
    private $endHour;

    /**
     * HourManagerConfig constructor.
     */
    public function __construct($hoursByDay)
    {
        $this->hours = $hoursByDay;
        $now = new \DateTime();

        $today = $hoursByDay[$now->format('N') - 1];

        $startHour = \DateTime::createFromFormat('H:i', $today[0]);

        $endHour = \DateTime::createFromFormat('H:i', $today[1]);

        $nowHI = $now->format('H:i');

        if ($nowHI < '23:59') {
            $endHour->modify('+1 day');
        }

        if ($nowHI > '00:00' && $nowHI < $today[1]) {
            $startHour->modify('-1 day');
        }

        $this->startHour = $startHour;
        $this->endHour = $endHour;
    }

    /**
     * @return bool
     *
     * @throws \Exception
     */
    public function isOpen()
    {
        $now = new \DateTime();

        return $this->startHour <= $now && $this->endHour >= $now;
    }

    /**
     * @todo rendre meilleur un jour
     *
     * @return array
     */
    public function getHoursFormatted()
    {
        return [
            'Lundi' => $this->hours[0][0].' à '.$this->hours[0][1],
            'Mardi' => $this->hours[1][0].' à '.$this->hours[1][1],
            'Mercredi' => $this->hours[2][0].' à '.$this->hours[2][1],
            'Jeudi' => $this->hours[3][0].' à '.$this->hours[3][1],
            'Vendredi' => $this->hours[4][0].' à '.$this->hours[4][1],
            'Samedi' => $this->hours[5][0].' à '.$this->hours[5][1],
            'Dimanche' => $this->hours[6][0].' à '.$this->hours[6][1],
        ];
    }

    /**
     * @return string
     */
    public function getTodayStartHour()
    {
        return $this->startHour->format('H\hi');
    }

    /**
     * @return string
     */
    public function getTodayEndHour()
    {
        return $this->endHour->format('H\hi');

    }

}