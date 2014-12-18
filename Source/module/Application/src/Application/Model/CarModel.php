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

/**
 *  Car Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
 class CarModel extends Model
 {
     /**
      * Get all cars by ID
      *
      * @param $id string
      * @return \Application\System\matrix|null
      */
     public function getAllCars($id)
     {
         return $this->more('usp_getAllCars', array("'$id'"));
     }

     public function getCar($id)
     {
         return $this->more('usp_findCars', array("'BangSoXe'", "'$id'"));
     }

     /**
      * Create new car
      *
      * @param $id string
      * @param $type int
      * @param $operator string
      * @param $route string
      * @throws CustomException SqlException
      * @throws \Exception
      */
     public function createCar($id, $type, $operator, $route)
     {
         try {
             $this->non('usp_createCar', array("'$id'", "$type", "'$operator'", "'$route'"));
         } catch (CustomException $e) {
             throw $e;
         }
     }

     /**
      * Update car
      *
      * @param $id string
      * @param $type int
      * @param $route string
      * @throws CustomException SqlException
      * @throws \Exception
      */
     public function updateCar($id, $type, $route)
     {
         try {
             $this->non('usp_updateCar', array("'$id'", "$type", "'$route'"));
         } catch (CustomException $e) {
             throw $e;
         }
     }
 }