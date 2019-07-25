<?php

namespace Delivery\ApiBundle\Manager\Hour;

/**
 * Class HourManagerInterface
 */
interface HourManagerInterface
{
    /**
     * Return true it the site is actually open.
     *
     * @return bool
     */
    public function isOpen();

    /**
     * Return a formatted hours informations.
     *
     * @return array|mixed
     */
    public function getHoursFormatted();

    /**
     * @return string
     */
    public function getTodayStartHour();

    /**
     * @return string
     */
    public function getTodayEndHour();
}