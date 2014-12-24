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
use Application\System\Model;
use Application\System\Regex;

/**
 *  Regulation Model
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

    public function getName($name)
    {
        return $this->one('uf_getProvinceName', array("$name"));
    }
}