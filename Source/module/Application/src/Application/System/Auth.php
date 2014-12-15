<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *
 */
namespace Application\System;

use Application\Model\AdminModel;

/**
 *  Authentication
 *
 * @category   VeXeCuaTui Project
 * @package    Application\System
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class Auth extends App
{
    /**
     * Is logged user
     *
     * @var bool
     */
    public $login;

    /**
     * Is administrator
     *
     * @var bool
     */
    public $admin;

    /**
     * Admin Model
     *
     * @var AdminModel
     */
    public $model;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->model = new AdminModel();
        $this->login = false;
        $this->admin = false;

        $id = $this->session('id');
        $isAdmin = $this->session('isAdmin');

        if (!empty($id)) {
            $this->login = true;
        }

        if ((!empty($id)) && ($isAdmin === 1)) {
            $this->admin = true;
        }
    }

    /**
     * Get ID of Current User
     *
     * @return string
     */
    public function currentUser()
    {
        return $this->session('id');
    }

    /**
     * Handling log in
     *
     * @param $user string
     * @param $pass string
     * @return bool
     */
    public function login($user, $pass)
    {
        if ($this->login) {
            return true;
        }

        return $this->model->login($user, $pass);
    }

    /**
     * Handling log out
     *
     */
    public function logout()
    {
        $this->login = false;
        $this->model->logout();
    }
}