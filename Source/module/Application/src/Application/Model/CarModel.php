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

     /**
      * Get car
      *
      * @param $operator string
      * @param $id string
      * @return \Application\System\matrix|null
      */
     public function getCar($operator, $id)
     {
         return $this->more('usp_findCars', array("'$operator'", "'BangSoXe'", "'$id'"));
     }

     /**
      * Find cars with condition
      *
      * @param $operator string
      * @param $condition string
      * @param $key string
      * @return \Application\System\matrix|null
      */
     public function findCars($operator, $condition, $key)
     {
         if (Regex::checkSqlInjection($condition) && Regex::checkSqlInjection($key)) {
             $result = $this->more('usp_findCars', array("'$operator'", "'$condition'", "N'$key'"));

             if (empty($result)) {
                 $result = array();
             }
         } else {
             $result = array();
         }

         return $result;
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

     /**
      * Delete Car
      *
      * @param $id
      * @throws CustomException SqlException
      */
     public function deleteCar($id)
     {
         try {
             $this->non('usp_deleteCar', array("'$id'"));
         } catch (CustomException $e) {
             throw $e;
         }
     }
 }