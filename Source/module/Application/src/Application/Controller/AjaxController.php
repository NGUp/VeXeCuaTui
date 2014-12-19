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
use Application\Model\CarModel;
use Application\Model\RegulationModel;
use Application\Model\RouteModel;
use Application\System\Auth;
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

    /**
     * Add Regulation
     *
     * @throws CustomException SqlException
     */
    public function addRegulationAction()
    {
        try {
            $regulation = new RegulationModel();

            $date_from = $this->post('regulation_date_from');
            $date_to = $this->post('regulation_date_to');
            $percent = $this->post('regulation_percent');
            $reason = $this->post('regulation_reason');

            $regulation->createRegulation($date_from, $date_to, $percent, $reason);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Edit Regulation
     *
     * @throws CustomException SqlException
     */
    public function editRegulationAction()
    {
        try {
            $regulation = new RegulationModel();

            $id = $this->post('regulation_id');
            $date_from = $this->post('regulation_date_from');
            $date_to = $this->post('regulation_date_to');
            $percent = $this->post('regulation_percent');
            $reason = $this->post('regulation_reason');

            $regulation->updateRegulation($id, $date_from, $date_to, $percent, $reason);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Add Car
     *
     * @throws CustomException SqlException
     */
    public function addCarAction()
    {
        try {
            $car = new CarModel();

            $id = $this->post('car_id');
            $type = $this->post('car_type');
            $operator = $this->post('car_operator');
            $route = $this->post('car_route');

            $car->createCar($id, $type, $operator, $route);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Edit Car
     *
     * @throws CustomException SqlException
     */
    public function editCarAction()
    {
        try {
            $car = new CarModel();

            $id = $this->post('car_id');
            $type = $this->post('car_type');
            $route = $this->post('car_route');

            $car->updateCar($id, $type, $route);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Delete Car
     *
     * @throws CustomException SqlException
     */
    public function deleteCarAction()
    {
        try {
            $car = new CarModel();

            $id = $this->post('car_id');

            $car->deleteCar($id);
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }

    /**
     * Handling Login
     */
    public function loginAction()
    {
        try {
            $user = $this->post('admin_login_user');
            $hash = $this->post('admin_login_hash');

            $auth = new Auth();

            if (!$auth->login($user, $hash)) {
                echo 'Tên đăng nhập hoặc mật khẩu không chính xác.';
            }
            die();
        } catch (CustomException $e) {
            $e->getError();
        }
    }
} 