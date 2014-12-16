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

/**
 *  Ajax Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class AjaxModel extends Model
{
    private static $static_ajax;

    /**
     * Singleton Pattern
     *
     * @return AjaxModel
     */
    public static function getInstance()
    {
        if (!self::$static_ajax)
        {
            self::$static_ajax = new AjaxModel();
        }
        return self::$static_ajax;
    }

    public function checkAvailableOperatorName($name)
    {
        return $this->one('uf_checkAvailableOperatorName', array("N'$name'"));
    }
}