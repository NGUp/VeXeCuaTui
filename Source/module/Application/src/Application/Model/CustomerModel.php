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
 *  Customer Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class CustomerModel extends Model
{
    public function getCustomerId()
    {
        return $this->one('uf_getCustomerId');
    }

    public function createCustomer($id, $name, $email, $phone, $pass)
    {
        $this->non('usp_createCustomer', array("'$id'", "N'$name'", "'$email'", "'$phone'", "'$pass'"));
    }

    public function login($id, $hash)
    {
        return $this->more('usp_loginCustomer', array("'$id'", "'$hash'"));
    }
}