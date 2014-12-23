<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *
 */
namespace Application\System;

/**
 *  Regular Expression
 *
 * Using Regular Expression for check Pattern
 *
 * @category   VeXeCuaTui Project
 * @package    Application\System
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class Regex
{
    /**
     * Checking Sql Injection error
     *
     * @param $data string
     * @return bool
     */
    public static function checkSqlInjection($data)
    {
        $pattern = '/[\';]/';

        if (preg_match($pattern, $data, $matches, PREG_OFFSET_CAPTURE) == false) {
            return true;
        }

        return false;
    }
}