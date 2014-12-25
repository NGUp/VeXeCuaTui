<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *  Loi Nguyen <loint@penlook.com>
 *
 */
namespace Application\Controller;

use Application\System\Auth;
use Zend\Http\Header\ContentType;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
 *  Base Controller
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Controller
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
abstract class BaseController extends AbstractActionController
{
    /**
     * Layout Folder
     *
     * @var string
     */
    public $layout_folder;

    /**
     * Sets of css
     *-
     * @var array cascading style sheet array
     */
    public $css;

    /**
     * Sets of js
     *
     * @var array javascript array
     */
    public $js;

    /**
     * @var Auth
     */
    public $auth;

    /**
     * Initialize Application
     * Init default components of application such as: js, css, title ...
     *
     */
    public function init()
	{
		$this->out = $this->layout();

        // Global default params
		$this->out->title = 'Vé xe của tui';

        // Default CSS & Javascript
        $this->add('css',
            'bootstrap',
            'bootstrap-theme',
            'jquery-ui',
            'components/hover',
            'core'
        );

        $this->add('js',
            'jquery',
            'jquery-ui',
            'bootstrap',
            'angular',
            'core'
        );

		// Add custom global css
		if (!empty($this->css)) {
            foreach ($this->css as $style) {
                $this->add('css', $style);
            }
        }

        // Add custom global js
        if (!empty($this->js)) {
            foreach ($this->js as $script) {
                $this->add('js', $script);
            }
        }
	}

    /**
     * Choose the folder layout and custom css, js in its view
     *
     * @author: Loi Nguyen <loint@penlook.com>
     *          Nam Vo <vhnam2504@gmail.com>
     *
     * @param $layout
     * @param array $css
     * @param array $js
     */
    public function setLayout($layout, $css = array(), $js = array())
    {
        $this->layout_folder = 'Application/' . $layout;
        $this->css = $css;
        $this->js = $js;
    }

    /**
     * Pass data array to page
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param mixed $array
     * @param ViewModel $page
     */
    public function view($page, $array)
    {
        foreach ($array as $key => $value) {
            $page->$key = $value;
        }
    }

    /**
     * Pass data array
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param mixed $key
     */
    public function add($key)
    {
        $num = func_num_args();
        if ($num < 2) {
            return;
        }

        $list = func_get_args();
        $arr = $this->out->$key;

        for ($i = 1; $i < $num; $i++) {
            $arr[] = $list[$i];
        }

        $this->out->$key = $arr;
    }

    /**
     * Support Javascript data inline to pass data from PHP to JS
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param $key
     * @param $value
     * @param bool $quote
     * @param bool $initialize
     */
    public function js($key, $value, $quote = false, $initialize = true)
    {
        $str = $this->out->script;

        if ($quote) {
            $value = '"' . $value . '"';
        }

        $str .= ( $initialize ? 'var ' : '') . $key . '=' . $value . ';';
        $this->out->script = $str;
    }

    /**
     * Angular
     * Integrate angular module
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param string $module
     */
    public function angular($module)
    {
        $this->out = $this->layout();
        $angular = $this->out->angular;
        $angular.= $module . '';
        $this->out->angular = $angular;
    }

    /**
     * Create new page
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param string $page_name
     * @return ViewModel $page
     */
    public function createPage($page_name)
    {
        $this->init();

        // Setup layout
        $page = new ViewModel();

        $page->setTemplate($this->layout_folder . '/layout.phtml');

        // Create page content
        $content = new ViewModel();
        $content->setTemplate($this->layout_folder . '/' . $page_name . '.phtml');

        // Page content in layout
        $page->addChild($content);
        return $page;
    }

    /**
     * Get child in page
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param $page
     * @return mixed
     */
    public function getContentView($page)
    {
        $child = $page->getChildren();
        return $child[0];
    }

    /**
     * Pass variable from Controller to Global layout
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param $type
     * @param $str
     * @return mixed
     */
    public function out($type, $str)
    {
        $header = new ContentType();
        $header->value = $type . '; charset=utf-8';
        $this->getResponse()->getHeaders()->addHeader($header);

        return $this->response->setContent($str);
    }

    /**
     * Convert array to object
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param $array
     * @return \stdClass
     */
    public function array2object($array)
    {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            $object->$key = $value;
        }
        return $object;
    }

    /**
     * get - $_GET
     * get is used instead of PHP - $_GET, Unless $key, it will return all of $_GET params
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param string $key
     * @return mixed object | string
     */
    public function get($key = null)
    {
        return is_null($key) ? $this->array2object($this->params()->fromQuery()) : $this->params()->fromQuery($key);
    }

    /**
     * post - $_POST
     * post is used instead of PHP - $_POST, Unless $key, it will return all of $_POST params
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param string $key
     * @return mixed object|string
     */
    public function post($key = null)
    {
        return is_null($key) ? $this->array2object($this->params()->fromPost()) : $this->params()->fromPost($key);
    }

    /**
     * Redirect to URL
     *
     * @param $url string
     */
    public function go($url)
    {
        $this->redirect()->toUrl($url);
    }

    /**
     * Get Hypertext Transfer Protocol
     *
     * @return string|null
     */
    public function getMethod()
    {
        return $this->getRequest()->getMethod();
    }

    /**
     * JSON
     * Support for JSON Data (one or multi dimesional)
     *
     * @author: Loi Nguyen <loint@penlook.com>
     * @param $data
     * @param bool $model
     * @return JsonModel|null|string
     */
    public function json($data, $model = true)
    {
        $result = null;

        if ($model) {
            // return JSON Response, e.g ajax request
            $result = new JsonModel($data);
        } else {
            if (is_array($data[0])) {
                $tmp = array();
                foreach ($data as $row)
                    $tmp[] = $row;
                $data = $tmp;
            }

            $result = json_encode($data);

            //$result = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($data));
        }

        // Return json string
        return $result;
    }

    /**
     * Set status code and dispatch error
     *
     * @param $code int
     * @param $error string
     */
    public function error($code, $error)
    {
        $this->getResponse()->setStatusCode($code);
        echo "<h1>$code $error</h1>";
        header("http/1.0 $code $error");
        die();
    }
}
