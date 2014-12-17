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

     public function indexAction()
     {
         $id = $this->post('operator_id');

         $page = $this->createPage('index');
         $page->permission = 'Moderator';
         $view = $this->getContentView($page);
         $view->cars = $this->car->getAllCars($id);

         $this->angular('moderator-car');

         return $page;
     }
 }