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
 *  Regulation Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class RegulationModel extends Model
{
    /**
     * Get all Regulations
     *
     */
    public function getAll()
    {
        return $this->more('usp_findAllRegulation');
    }

    /**
     * Create new Regulation
     *
     * @param $id string
     * @param $dateFrom string
     * @param $dateTo string
     * @param $percent int
     * @param $reason string
     */
    public function createRegulation($id, $dateFrom, $dateTo, $percent, $reason)
    {
        if (is_null($reason)) {
            $this->non('usp_createRegulation', array("'$id'", "'$dateFrom'", "'$dateTo'", "$percent", 'NULL'));
        } else {
            $this->non('usp_createRegulation', array("'$id'", "'$dateFrom'", "'$dateTo'", "$percent", "N'$reason'"));
        }
    }

    /**
     * Update a regulation
     *
     * @param $id string
     * @param $dateFrom string
     * @param $dateTo string
     * @param $percent int
     * @param $reason string
     */
    public function updateRegulation($id, $dateFrom, $dateTo, $percent, $reason)
    {
        $this->non('usp_updateRegulation', array("'$id'", "'$dateFrom'", "'$dateTo'", "$percent", "N'$reason'"));
    }

    /**
     * Delete a regulation
     *
     * @param $id string
     */
    public function deleteRegulation($id)
    {
        $this->non('usp_deleteRegulation', array("'$id'"));
    }

    /**
     * Find (a) regulation(s) with condition
     *
     * @param $condition string
     * @param $key string
     * @return \Application\System\matrix|array|null
     */
    public function findRegulation($condition, $key)
    {
        $pattern = '/[\';]/';

        if (preg_match($pattern, $condition, $matches, PREG_OFFSET_CAPTURE) == false &&
            preg_match($pattern, $key, $matches, PREG_OFFSET_CAPTURE) == false) {
            $result = $this->more('usp_findRegulation', array("'$condition'", "N'$key'"));

            if (empty($result)) {
                $result = array();
            }
        } else {
            $result = array();
        }

        return $result;
    }
}