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
 *  Trip Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class TripController extends BaseController
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
            'trip/search-form',
            'trip/search-result',
            'trip/book',
            'trip/payment'
        );

        $layout = 'trip';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Searching Trip
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function searchAction()
    {
        $page = $this->createPage('search');

        return $page;
    }
}