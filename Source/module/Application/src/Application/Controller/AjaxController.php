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

use Application\Model\AdminModel;
use Application\Model\AjaxModel;
use Application\Model\RouteModel;
use Application\System\CustomException;

/**
 *  Admin Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class AjaxController extends BaseController
{

    /**
     * Ajax Model
     *
     * @var AjaxModel
     */
    public $ajax;

    public function __construct()
    {
        $this->ajax = AjaxModel::getInstance();
    }

    /**
     * Index Page
     *
     */
    public function indexAction()
    {
        $this->error(404, 'Not Found');
    }

    /**
     * Add Route
     *
     * @throws CustomException SqlException
     */
    public function addRouteAction()
    {
        try {
            $route = new RouteModel();

            $id = $this->post('operator_id');
            $start_time = $this->post('route_start_time');
            $start_date = $this->post('route_start_date');
            $start_location = $this->post('route_start_location');
            $end_location = $this->post('route_end_location');
            $price = $this->post('route_price');
            $stop = $this->post('route_stop');

            $route->createRoute($id, $start_date, $start_time, $start_location, $end_location, $price, $stop);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Edit Route
     *
     * @throws CustomException SqlException
     */
    public function editRouteAction()
    {
        try {
            $route = new RouteModel();

            $id = $this->post('route_id');
            $start_time = $this->post('route_start_time');
            $start_date = $this->post('route_start_date');
            $start_location = $this->post('route_start_location');
            $end_location = $this->post('route_end_location');
            $price = $this->post('route_price');
            $stop = $this->post('route_stop');

            $route->updateRoute($id, $start_date, $start_time, $start_location, $end_location, $price, $stop);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Add manager
     *
     * @throws CustomException SqlException
     */
    public function addManagerAction()
    {
        try {
            $admin = new AdminModel();

            $id = $this->post('manager_id');
            $name = $this->post('manager_name');
            $user = $this->post('manager_user');
            $operator = $this->post('manager_operator');

            $admin->createManager($id, $name, $user, $operator);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Change password manager
     *
     * @throws CustomException SqlException
     */
    public function editManagerAction()
    {
        try {
            $admin = new AdminModel();

            $id = $this->post('manager_id');
            $oldPass = $this->post('manager_old_password');
            $newPass = $this->post('manager_new_password');
            $confirm = $this->post('manager_confirm_password');

            $admin->updateManager($id, $oldPass, $newPass, $confirm);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Check Available Operator Name
     *
     * @return bool
     * @throws CustomException SqlException
     */
    public function checkAvailableOperatorNameAction()
    {
        try {
            $name = $this->post('operator_name');

            $result = $this->ajax->checkAvailableOperatorName($name);
            print_r($result[0]);
            die();
        } catch(CustomException $e) {
            $e->getError();
        }
    }
} 