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
use Application\System\Auth;

/**
 *  Admin Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class AdminController extends BaseController
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

        $js = array(
            'components/bootstrap-file-input',
            'components/bootstrap-combobox',
            'encode',
            'backend/login',
            'backend/mod-sidebar',
            'backend/header',
            'backend/setting',
            'backend/admin',
            'backend/moderator'
        );

        $css = array(
            'backend/backend',
            'backend/backend-core',
            'components/bootstrap-file-input',
            'components/bootstrap-combobox',
            'gen/backend-header',
        );

        $layout = 'backend';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Index Page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        if ($this->auth->login) {
            if ($this->auth->admin) {
                $this->angular('administrator');

                $page = $this->adminAction();
            } else {
                $this->angular('moderator');

                $page = $this->modAction();
            }
        } else {
            $this->angular('login');

            $page = $this->createPage('index');
        }

        return $page;
    }

    /**
     * Administrator Page
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function adminAction()
    {
        $page = $this->createPage('admin');
        $view = $this->getContentView($page);
        $view->permission = 'Administrator';

        $this->setInformation();

        return $page;
    }

    /**
     * Moderator Page
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function modAction()
    {
        $page = $this->createPage('mod');
        $view = $this->getContentView($page);
        $view->permission = 'Moderator';

        $this->js('operator', $this->admin->getOperator(), true);
        $this->setInformation();

        return $page;
    }

    /**
     * Handling Login
     *
     */
    public function loginAction()
    {
        $user = $this->post('admin_login_user');
        $hash = $this->post('admin_login_hash');

        if ($this->auth->login($user, $hash)) {
            $this->admin = true;
        }

        $this->go('/admin');
    }

    /**
     * Handling log out
     *
     */
    public function logoutAction()
    {
        $this->auth->logout();
        $this->go('/admin');
    }

    public function settingAction()
    {
        if (!$this->auth->login) {
            $this->error(403, 'Forbidden');
        }

        $page = $this->createPage('setting');

        $view = $this->getContentView($page);

        if ($this->auth->admin) {
            $view->permission = 'Administrator';
        } else {
            $view->permission = 'Moderator';
        }

        $this->js('operator', $this->admin->getOperator(), true);
        $view->user = $this->admin->getUsername();
        $this->setInformation();
        $this->angular('backend-setting');

        return $page;
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