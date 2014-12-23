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
*  Route Model
*
* @category   VeXeCuaTui Project
* @package    Application\Model
* @author     Nam Vo <vhnam2504@gmail.com>
* @copyright  Never Give Up Team
* @license    Education
*/
class RouteModel extends Model
{
    /**
     * Get All Routes
     *
     * @return \Application\System\matrix|null
     */
    public function getAll()
    {
        return $this->more('usp_findAllRoute');
    }

    /**
     * Create new Route
     *
     * @param $id string
     * @param $start_date string
     * @param $start_time string
     * @param $start_location string
     * @param $end_location string
     * @param $price int
     * @param $stop string
     * @throws CustomException SqlException
     */
    public function createRoute($id, $start_date, $start_time, $start_location, $end_location, $price, $stop)
    {
        try {
            $this->non('usp_createRoute', array("'$id'", "'$start_date'", "'$start_time'", "N'$start_location'", "N'$end_location'", "$price", "N'$stop'"));
        } catch (CustomException $e) {
            throw $e;
        }
    }

    /**
     * Update Route
     *
     * @param $id string
     * @param $start_date string
     * @param $start_time string
     * @param $start_location string
     * @param $end_location string
     * @param $price int
     * @param $stop string
     * @throws CustomException SqlException
     */
    public function updateRoute($id, $start_date, $start_time, $start_location, $end_location, $price, $stop)
    {
        try {
            $this->non('usp_updateRoute', array("'$id'", "'$start_date'", "'$start_time'", "N'$start_location'", "N'$end_location'", "$price", "N'$stop'"));
        } catch (CustomException $e) {
            throw $e;
        }
    }

    /**
     * Delete Route
     *
     * @param $id string
     * @throws CustomException SqlException
     */
    public function deleteRoute($id)
    {
        try {
            $this->non('usp_deleteRoute', array("'$id'"));
        } catch (CustomException $e) {
            throw $e;
        }
    }

    /**
     * Find Route(s)
     *
     * @param $condition string
     * @param $key string
     * @return \Application\System\matrix|array|null
     */
    public function findRoute($condition, $key)
    {
        if (Regex::checkSqlInjection($condition) && Regex::checkSqlInjection($key)) {
            $result = $this->more('usp_findRoutes', array("'$condition'", "N'$key'"));

            if (empty($result)) {
                $result = array();
            }
        } else {
            $result = array();
        }

        return $result;
    }
}