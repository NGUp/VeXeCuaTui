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

use Application\Model\RegulationModel;
use Application\System\Auth;

/**
 *  Regulation Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class RegulationController extends BaseController
{
    /**
     * Authentication
     *
     * @var Auth
     */
    public $auth;

    /**
     * Regulation Model
     *
     * @var RegulationModel
     */
    public $regulation;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->auth = new Auth();
        $this->regulation = new RegulationModel();

        if (!$this->auth->login) {
            echo '<h1>403 Forbidden</h1>';
            header('http/1.0 403 Forbidden');
            die();
        }

        $js = array(
            'moment',
            'components/bootstrap-datetimepicker',
            'backend/header',
            'encode',
            'backend/admin',
            'regulation/regulation',
            'regulation/search-regulation',
            'regulation/add-regulation',
            'regulation/edit-regulation'
        );

        $css = array(
            'backend/backend',
            'backend/backend-core',
            'components/bootstrap-datetimepicker',
            'gen/backend-header',
            'backend/admin'
        );

        $layout = 'regulation';

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

        $this->angular('administrator-regulation');

        if (is_null($condition) && is_null($key)) {
            $view->regulations = $this->regulation->getAll();
        } else {
            $view->regulations = $this->regulation->findRegulation($condition, $key);
        }

        return $page;
    }

    /**
     * Add Regulation Page | Handling add Regulation
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $page = $this->createPage('add-regulation');
        $page->permission = 'Administrator';

        $this->angular('administrator-add-regulation');

        return $page;
    }

    /**
     * Edit Manager Page | Handling edit Manager
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $id = $this->post('regulation_id');
        $page = $this->createPage('edit-regulation');
        $page->permission = 'Administrator';
        $view = $this->getContentView($page);
        $view->regulation = $this->regulation->findRegulation('MaDT', $id);

        $this->angular('administrator-edit-regulation');

        return $page;
    }

    /**
     * Handling delete Manager
     */
    public function deleteAction()
    {
        $id = $this->post('regulation_id');

        $this->regulation->deleteRegulation($id);

        $this->go('/admin/regulation');
    }
}