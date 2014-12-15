<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *  Loi Nguyen <loint@penlook.com>
 *
 */
namespace Application\System;

/**
 *  Application
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class App
{
    public function __construct()
    {
    }

    /**
     * Set Session
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param $key
     * @param bool $value
     * @return bool
     */
    public static function session($key, $value=false)
    {
        if ($value!==false) {
            $_SESSION[$key] = $value;
            return true;
        }

        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }
}