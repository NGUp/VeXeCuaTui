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

use Application\Model\ExpressModel;
use Application\Model\ProvinceModel;
use Application\System\Regex;

/**
 *  Express Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class ExpressController extends BaseController
{
    /**
     * @var ExpressModel
     */
    public $express;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $js = array(
            'components/bootstrap-combobox',
            'moment',
            'components/bootstrap-datetimepicker',
            'components/bootstrap-tagsinput',
            'components/bootstrap-tagsinput-angular',
            'express/search-bar',
            'express/search-result',
            'express/book-ticket',
            'express/payment',
            'express/express'
        );

        $css = array(
            'gen/header',
            'gen/footer',
            'components/bootstrap-combobox',
            'components/bootstrap-datetimepicker',
            'components/bootstrap-tagsinput',
            'express/search-form',
            'express/search-result',
            'express/book',
            'express/payment'
        );

        $this->express = new ExpressModel();
        $layout = 'express';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Finding available Trip
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $from = $this->get('from');
        $to = $this->get('to');
        $date = $this->get('date');

        $provinces = new ProvinceModel();
        $page = $this->createPage('search');
        $view = $this->getContentView($page);
        $view->trips = $this->express->findTrip($from, $to, $date);
        $view->from = $this->express->getName($from);
        $view->to = $this->express->getName($to);
        $view->date = $date;
        $view->provinces = $provinces->getAll();

        $this->angular('express');

        return $page;
    }
}