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

use Application\Model\ProvinceModel;

/**
 *  Index Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class IndexController extends BaseController
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
            'encode',
            'components/bootstrap-datetimepicker',
            'gen/header',
            'index/index'
        );

		$css = array(
            'gen/header',
            'gen/footer',
            'index/index',
            'components/bootstrap-combobox',
            'components/bootstrap-datetimepicker'
        );

		$layout = 'index';

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

        $provinces = new ProvinceModel();
        $view = $this->getContentView($page);
        $view->provinces  = $provinces->getAll();
        $this->angular('index');

		return $page;
	}
}