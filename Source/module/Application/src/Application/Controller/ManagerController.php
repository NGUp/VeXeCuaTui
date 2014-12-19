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
use Application\Model\OperatorModel;
use Application\System\Auth;

/**
 *  Manager Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class ManagerController extends BaseController
{
    /**
     * Authentication
     *
     * @var Auth
     */
    public $auth;

    /**
     * Admin Model
     *
     * @var AdminModel
     */
    public $admin;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->auth = new Auth();
        $this->admin = new AdminModel();

        if (!$this->auth->login) {
            $this->error(403, 'Forbidden');
        }

        $js = array(
            'components/bootstrap-file-input',
            'components/bootstrap-combobox',
            'backend/header',
            'encode',
            'backend/admin-sidebar',
            'backend/admin',
            'manager/search-manager',
            'manager/manager',
            'manager/add-manager',
            'manager/edit-manager'
        );

        $css = array(
            'backend/backend',
            'backend/backend-core',
            'components/bootstrap-file-input',
            'components/bootstrap-combobox',
            'gen/backend-header',
            'backend/admin'
        );

        $layout = 'manager';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Index Page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function  indexAction()
    {
        $condition = $this->get('condition');
        $key = $this->get('key');

        $page = $this->createPage('index');
        $page->permission = 'Administrator';
        $view = $this->getContentView($page);

        $this->setInformation();
        $this->angular('administrator-manager');

        if (is_null($condition) && is_null($key)) {
            $view->managers = $this->admin->getAll();
        } else {
            $view->managers = $this->admin->findManager($condition, $key);
        }

        return $page;
    }

    /**
     * Add Manager Page | Handling add manager
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $page = $this->createPage('add-manager');
        $page->permission = 'Administrator';

        $view = $this->getContentView($page);
        $operator = new OperatorModel();
        $view->operators = $operator->getAvailableOperators();

        $this->setInformation();
        $this->angular('administrator-add-manager');

        return $page;
    }

    /**
     * Edit Manager Page | Handling edit Manager
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $id = $this->post('manager_id');
        $permission = $this->post('is_edit_manager');

        if (!is_null($permission)) {
            $id = $this->post('manager_id');
            $name = $this->post('manager_name');
            $user = $this->post('manager_user');
            $pass = $this->post('manager_pass');
            $isAdmin = $this->post('manager_is_admin');
            $operator = $this->post('manager_operator');

            $this->admin->updateManager($id, $name, $user, $pass, $isAdmin, $operator);

            $this->go('/admin/manager');

        } else {
            $page = $this->createPage('edit-manager');
            $page->permission = 'Administrator';
            $operator = new OperatorModel();
            $view = $this->getContentView($page);

            $view->operators = $operator->getAll();
            $view->profile = $this->admin->getProfile($id);

            $this->js('permission', $view->profile['isAdmin'], true);
            $this->js('operator', trim($view->profile['operator']), true);

            $this->setInformation();
            $this->angular('administrator-edit-manager');

            return $page;
        }
    }

    /**
     * Handling delete Manager
     */
    public function deleteAction()
    {
        $id = $this->post('manager_id');
        $this->admin->deleteManager($id);

        $this->go('/admin/manager');
    }

    /**
     * Return JavaScript variables to View
     *
     */
    public function setInformation()
    {
        $this->js('id', $this->admin->getId(), true);
        $this->js('name', $this->admin->getName(), true);
    }
}