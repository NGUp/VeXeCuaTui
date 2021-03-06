<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *
 */

namespace Application\Controller;

use Application\Model\CarModel;
use Application\Model\OperatorModel;
use Application\Model\RouteModel;
use Application\System\Auth;

/**
 *  Car Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
 class CarController extends BaseController
 {
     /**
      * CarModel
      *
      * @var CarModel
      */
     public $car;

     /**
      * Constructor
      *
      */
     public function __construct()
     {
         $this->auth = new Auth();
         $this->car = new CarModel();

         if (!$this->auth->login) {
             $this->error(403, 'Forbidden');
         }

         $js = array(
             'components/bootstrap-combobox',
             'backend/mod-sidebar',
             'backend/header',
             'backend/admin',
             'car/search-car',
             'car/add-car',
             'car/edit-car',
             'car/delete-car',
             'car/car'
         );

         $css = array(
             'backend/backend',
             'backend/backend-core',
             'components/bootstrap-combobox',
             'gen/backend-header',
             'backend/admin'
         );

         $layout = 'car';

         $this->setLayout($layout, $css, $js);
     }

     /**
      * Index Car Page
      *
      * @return array|\Zend\View\Model\ViewModel
      */
     public function indexAction()
     {
         if ($this->getMethod() != 'POST') {
             $this->error('405', 'Method Not Allowed');
         }

         $id = $this->post('operator_id');
         $condition = $this->post('condition');
         $key = $this->post('key');

         $page = $this->createPage('index');
         $page->permission = 'Moderator';
         $view = $this->getContentView($page);

         if (is_null($condition) && is_null($key)) {
             $view->cars = $this->car->getAllCars($id);
         } else {
             $view->cars = $this->car->findCars($id, $condition, $key);
         }

         $this->angular('moderator-car');
         $this->js('operator', "'$id'");

         return $page;
     }

     /**
      * Add Car Page
      *
      * @return \Zend\View\Model\ViewModel
      */
     public function addAction()
     {
         $page = $this->createPage('add-car');

         $page->permission = 'Moderator';
         $id = $this->post('operator_id');
         $view = $this->getContentView($page);

         $route = new RouteModel();
         $view->routes = $route->getAllByOperator($id);

         $this->angular('moderator-add-car');
         $this->js('operator', "'$id'");

         return $page;
     }

     /**
      * Edit Car Page
      *
      * @return \Zend\View\Model\ViewModel
      */
     public function editAction()
     {
         $page = $this->createPage('edit-car');

         $page->permission = 'Moderator';
         $id = $this->post('car_id');
         $operator_id = $this->post('operator_id');
         $view = $this->getContentView($page);

         $operator = new OperatorModel();
         $view->operators = $operator->getAll();

         $route = new RouteModel();
         $view->routes = $route->getAll();
         $view->car = $this->car->getCar($operator_id, $id);

         $this->angular('moderator-edit-car');
         $this->js('operator', "'$operator_id'");

         return $page;
     }
 }