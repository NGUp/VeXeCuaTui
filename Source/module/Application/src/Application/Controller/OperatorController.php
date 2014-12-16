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
 *  Operator Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class OperatorController extends BaseController
{
    /**
     * Authentication
     *
     * @var Auth
     */
    public $auth;

    /**
     * Operator Model
     *
     * @var OperatorModel
     */
    public $operator;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->auth = new Auth();
        $this->operator = new OperatorModel();

        if (!$this->auth->login) {
            $this->error(403, 'Forbidden');
        }

        $js = array(
            'components/bootstrap-file-input',
            'components/bootstrap-combobox',
            'backend/mod-sidebar',
            'backend/header',
            'operator/search-operator',
            'operator/operator',
            'operator/add-operator',
            'operator/edit-operator'
        );

        $css = array(
            'backend/backend',
            'backend/backend-core',
            'components/bootstrap-file-input',
            'components/bootstrap-combobox',
            'gen/backend-header',
            'backend/admin'
        );

        $layout = 'operator';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Index Page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        if (!$this->auth->admin) {
            $this->error(403, 'Forbidden');
        }

        $condition = $this->get('condition');
        $key = $this->get('key');

        $page = $this->createPage('index');
        $page->permission = 'Administrator';
        $view = $this->getContentView($page);
        $this->angular('administrator-operator');

        if (is_null($condition) && is_null($key)) {
            $view->operators = $this->operator->getAll();
        } else {
            $view->operators = $this->operator->findOperator($condition, $key);
        }

        return $page;
    }

    /**
     * Handling add Operator | Add operator Page
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        if (!$this->auth->admin) {
            $this->error(403, 'Forbidden');
        }

        $permission = $this->post('is_add_operator');

        if (!is_null($permission)) {
            $name = $this->post('operator_name');
            $file_name = null;

            if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
                $file_name = $_FILES['logo']['name'];
                $file = getcwd() . '/public/img/Operators/' . $file_name;
                move_uploaded_file($_FILES['logo']['tmp_name'], $file);
            }

            $this->operator->createOperator($name, $file_name);

            $this->go('/admin/operator');

        } else {
            $page = $this->createPage('add-operator');
            $page->permission = 'Administrator';

            $this->angular('administrator-add-operator');

            return $page;
        }
    }

    /**
     * Handling edit Operator | Edit Operator Page
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        if ($this->auth->admin) {
            $this->error(403, 'Forbidden');
        }

        if ($this->getMethod() != 'POST') {
            $this->error(405, 'Method Not Allowed');
        }

        $id = $this->post('operator_id');
        $permission = $this->post('is_edit_operator');

        if (!is_null($permission)) {
            $name = $this->post('operator_name');
            $tmp_logo = $this->post('operator_tmp_logo');
            $file_name = $tmp_logo;

            if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
                if ($_FILES['logo']['name'] != $tmp_logo) {
                    $file_name = $_FILES['logo']['name'];
                    $file = getcwd() . '/public/img/Operators/' . $file_name;
                    move_uploaded_file($_FILES['logo']['tmp_name'], $file);
                }
            }

            $this->operator->updateOperator($id, $name, $file_name);

            $this->go('/admin');

        } else {
            $page = $this->createPage('edit-operator');
            $page->permission = 'Moderator';
            $admin = new AdminModel();
            $this->js('operator', $admin->getOperator(), true);
            $view = $this->getContentView($page);
            $view->operator = $this->operator->getOperator($id);

            $this->angular('moderator-edit-operator');

            return $page;
        }
    }

    /**
     * Handling delete Operator
     *
     */
    public function deleteAction()
    {
        if (!$this->auth->admin) {
            $this->error(403, 'Forbidden');
        }

        $id = $this->post('operator_id');
        $this->operator->deleteOperator($id);

        $this->go('/admin/operator');
    }
}