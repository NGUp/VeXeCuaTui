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
use Application\Model\ProvinceModel;
use Application\Model\RouteModel;
use Application\System\Auth;

/**
 *  Route Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class RouteController extends BaseController
{
    /**
     * Authentication
     *
     * @var Auth
     */
    public $auth;

    /**
     * Route Model
     *
     * @var RouteModel
     */
    public $route;

    /**
     * Construction
     *
     */
    public function __construct()
    {
        $this->auth = new Auth();
        $this->route = new RouteModel();

        if (!$this->auth->login || $this->auth->admin) {
            $this->error(403, 'Forbidden');
        }

        $js = array(
            'moment',
            'typeahead',
            'components/bootstrap-datetimepicker',
            'components/bootstrap-combobox',
            'components/bootstrap-tagsinput',
            'components/bootstrap-tagsinput-angular',
            'backend/mod-sidebar',
            'backend/header',
            'route/search-route',
            'route/route',
            'backend/moderator',
            'route/add-route',
            'route/edit-route'
        );

        $css = array(
            'components/bootstrap-tagsinput',
            'components/bootstrap-datetimepicker',
            'components/bootstrap-combobox',
            'backend/backend-core',
            'gen/backend-header',
            'backend/admin'
        );

        $layout = 'route';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Route Index Page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $condition = $this->get('condition');
        $key = $this->get('key');

        $page = $this->createPage('index');
        $page->permission = 'Moderator';

        $admin = new AdminModel();
        $this->js('operator', $admin->getOperator(), true);
        $this->angular('moderator-route');
        $view = $this->getContentView($page);

        if (is_null($condition) && is_null($key)) {
            $view->routes = $this->route->getAllByOperator($admin->getOperator());
        } else {
            $view->routes = $this->route->findRoute($condition, $key);
        }

        return $page;
    }

    /**
     * Add Route Page | Handling add Route
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        if ($this->getMethod() != 'POST') {
            $this->error(405, 'Method Not Allowed');
        }

        $id = $this->post('operator_id');
        $page = $this->createPage('add-route');
        $page->permission = 'Moderator';
        $provinces = new ProvinceModel();
        $view = $this->getContentView($page);
        $view->id = $id;
        $view->provinces = $provinces->getAll();
        $this->angular('moderator-add-route');

        return $page;
    }

    /**
     * Edit Route Page | Handling Edit Route
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $id = $this->post('route_id');
        $page = $this->createPage('edit-route');
        $page->permission = 'Moderator';
        $provinces = new ProvinceModel();
        $view = $this->getContentView($page);
        $view->provinces = $provinces->getAll();
        $view->route = $this->route->findRoute('MaLT', $id);
        $admin = new AdminModel();
        $this->js('operator', $admin->getOperator(), true);

        $this->angular('moderator-edit-route');

        return $page;
    }

    /**
     * Handling delete Route
     *
     */
    public function deleteAction()
    {
        $id = $this->post('route_id');

        $this->route->deleteRoute($id);

        $this->go('/admin/route');
    }
}