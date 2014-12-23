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
            'book'
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


        $page = $this->createPage('search');

        return $page;
    }
}