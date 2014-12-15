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
            'components/bootstrap-datetimepicker',
            'index'
        );

		$css = array(
            'gen/header',
            'gen/footer',
            'index/cover',
            'components/bootstrap-combobox',
            'components/bootstrap-datetimepicker',
            'index/book-ticket'
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

		return $page;
	}
}