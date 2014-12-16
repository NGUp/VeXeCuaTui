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
 *  Operator Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class OperatorModel extends Model
{
    /**
     * Get all operators
     *
     * @return \Application\System\matrix|null
     */
    public function getAll()
    {
        return $this->more('usp_findAllOperator');
    }

    /**
     * Get a operator by ID
     *
     * @param $id string
     * @return array|null
     */
    public function getOperator($id)
    {
        $result = $this->more('usp_findOperator', array("'MaHangXe'", "'$id'"));

        return array(
            'id' => $result[0]['MaHangXe'],
            'name' => $result[0]['TenHangXe'],
            'logo' => $result[0]['Logo']
        );
    }

    public function findOperator($condition, $key)
    {
        $pattern = '/[\';]/';

        if (preg_match($pattern, $condition, $matches, PREG_OFFSET_CAPTURE) == false &&
            preg_match($pattern, $key, $matches, PREG_OFFSET_CAPTURE) == false) {
            $result = $this->more('usp_findOperator', array("'$condition'", "N'$key'"));

            if (empty($result)) {
                $result = array();
            }
        } else {
            $result = array();
        }

        return $result;
    }

    /**
     * Create operator
     *
     * @param $name string
     * @param $logo string
     */
    public function createOperator($name, $logo)
    {
        if (is_null($logo)) {
            $this->non('usp_createOperator', array("N'$name'", 'NULL'));
        } else {
            $this->non('usp_createOperator', array("N'$name'", "'$logo'"));
        }
    }

    /**
     * Update operator
     *
     * @param $id string
     * @param $name string
     * @param $logo string
     */
    public function updateOperator($id, $name, $logo)
    {
        if (is_null($logo)) {
            $this->non('usp_updateOperator', array("'$id'", "N'$name'", 'NULL'));
        } else {
            $this->non('usp_updateOperator', array("'$id'", "N'$name'", "'$logo'"));
        }
    }

    /**
     * Delete operator
     *
     * @param $id string
     */
    public function deleteOperator($id) {
        $this->non('usp_deleteOperator', array("'$id'"));
    }

    /**
     * Get available operators
     *
     * @return \Application\System\matrix|null
     */
    public function getAvailableOperators()
    {
        return $this->more('usp_getAvailableOperator');
    }
}