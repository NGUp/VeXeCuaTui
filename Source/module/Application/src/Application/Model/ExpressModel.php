<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *
 */
namespace Application\Model;

use Application\System\CustomException;
use Application\System\Model;
use Application\System\Regex;

/**
 *  Express Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class ExpressModel extends Model
{
    /**
     * Finding trip
     *
     * @param $from int
     * @param $to int
     * @param $date string
     * @return \Application\System\matrix|array|null
     */
    public function findTrip($from, $to, $date)
    {
        if (Regex::checkSqlInjection($from) && Regex::checkSqlInjection($to) && Regex::checkSqlInjection($date)) {
            $result = $this->more('usp_findTrip', array("$from", "$to", "'$date'"));
            if (empty($result)) {
                $result = array();
            }
        } else {
            $result = array();
        }

        return $result;
    }

    /**
     * Get Province Name
     *
     * @param $name string Province Id
     * @return bool|null|object
     */
    public function getName($name)
    {
        return $this->one('uf_getProvinceName', array("$name"));
    }

    /**
     * Get Trip information
     *
     * @param $trip string
     * @param $car string
     * @return \Application\System\matrix|null
     */
    public function getTripInfo($trip, $car)
    {
        return $this->more('usp_getTripInfo', array("'$trip'", "'$car'"));
    }

    /**
     * Book ticket(s)
     *
     * @param $customer string
     * @param $phone string
     * @param $email string
     * @param $tickets string
     * @param $car string
     * @throws CustomException
     * @throws \Exception
     */
    public function bookTickets($id, $customer, $phone, $email, $tickets, $route, $car)
    {
        try {
            $this->non('usp_bookTickets', array("'$id'", "N'$customer'", "'$phone'", "'$email'", "'$tickets,'", "'$route'", "'$car'"));
        } catch (CustomException $exception) {
            throw $exception;
        }
    }

    /**
     * Get Unpaid Ticket(s)
     *
     * @param $customer string
     * @throws CustomException
     * @throws \Exception
     * @return \Application\System\matrix|null
     */
    public function getUnpaidTickets($customer)
    {
        try {
            return $this->more('usp_getUnpaidTickets', array("'$customer'"));
        } catch (CustomException $exception) {
            throw $exception;
        }
    }

    /**
     * Remove booked ticket
     *
     * @param $ticket string
     * @param $car string
     * @param $route string
     * @param $seat string
     * @throws CustomException
     * @throws \Exception
     */
    public function removeTicket($ticket, $car, $route, $seat)
    {
        try {
            $this->non('usp_removeTicket', array("'$ticket'", "'$car'", "'$route'", "'$seat,'"));
        } catch (CustomException $exception) {
            throw $exception;
        }
    }
}