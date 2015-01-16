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
 *  Payment Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class PaymentController extends BaseController
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $js = array(
            'gen/header',
            'payment/payment'
        );

        $css = array(
            'gen/header',
            'gen/footer',
            'payment/payment'
        );

        $layout = 'payment';

        $this->setLayout($layout, $css, $js);
    }

    /**
     * Index Page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $page = $this->createPage('index');

        $view = $this->getContentView($page);
        $this->angular('payment');

        return $page;
    }
}