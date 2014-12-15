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
 *  Custom Exception
 *
 * @category   VeXeCuaTui Project
 * @package    Application\System
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class CustomException extends \Exception
{
    /**
     * Get error message
     *
     */
    public function getError()
    {
        echo $this->getMessage();
        die();
    }
}