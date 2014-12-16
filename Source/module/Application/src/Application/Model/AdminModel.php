<?php

/**
 * Copyright (C) 2014 Never Give Up Team
 *                    Vietnam
 *
 * Authors:
 *  Nam Vo <vhnam2504@gmail.com>
 *
 */
namespace Application\Model;

use Application\System\CustomException;
use Application\System\Model;

/**
 *  Administrator Model
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
class AdminModel extends Model
{
    /**
     * Login
     *
     * @param $user string
     * @param $hash string
     * @return bool
     */
    public function login($user, $hash)
    {
        $result = $this->more('usp_login', array("'$user'", "'$hash'"));

        if ($result) {
            $this->session('id', $result[0]['CMND']);
            $this->session('user', $user);
            $this->session('name', $result[0]['HoTen']);
            $this->session('isAdmin', $result[0]['QuanTriVien']);
            $this->session('operator', trim($result[0]['HangXe']));

            return true;
        } else {
            return false;
        }
    }

    /**
     * Log out
     *
     */
    public function logout()
    {
        $this->session('id', null);
        $this->session('user', null);
        $this->session('name', null);
        $this->session('isAdmin', null);
        $this->session('operator', null);
    }

    /**
     * Create new manager
     *
     * If $isAdmin is true, this is Administrator. Else, this is Moderator
     *
     * @param $id string
     * @param $name string
     * @param $user string
     * @param $operator string
     * @throws CustomException SqlException
     * @throws \Exception
     */
    public function createManager($id, $name, $user, $operator)
    {
        try {
            $this->non('usp_createManager', array("'$id'", "N'$name'", "'$user'", "'$operator'"));
        } catch (CustomException $e) {
            throw $e;
        }
    }

    /**
     * Update manager profile
     *
     * If $isAdmin is true, this is Administrator. Else, this is Moderator
     *
     * @param $id string
     * @param $name string
     * @param $user string
     * @param $pass string
     * @param $operator string
     * @throws CustomException SqlException
     * @throws \Exception
     */
    public function updateManager($id, $name, $user, $pass, $operator)
    {
        try {
            $this->non('usp_updateManager', array("'$id'", "N'$name'", "'$user'", "'$pass'", "'$operator'"));
        } catch (CustomException $e) {
            throw $e;
        }
    }

    /**
     * Delete manager profile
     *
     * @param $id
     */
    public function deleteManager($id)
    {
        $this->non('usp_deleteManager', array("'$id'"));
    }

    /**
     * Get Profile of Manager with ID
     *
     * @param $id string
     * @return array
     */
    public function getProfile($id)
    {
        $request = $this->more('usp_findManager', array("'CMND'", "'$id'"));

        $result = array(
            'id' => $request[0]['CMND'],
            'name' => $request[0]['HoTen'],
            'user' => $request[0]['TenDangNhap'],
            'isAdmin' => $request[0]['QuanTriVien'],
            'operator' => $request[0]['MaHangXe']
        );

        return $result;
    }

    /**
     * Find Manager(s)
     *
     * @param $condition string
     * @param $key string
     * @return \Application\System\matrix|array|null
     */
    public function findManager($condition, $key)
    {
        $pattern = '/[\';]/';

        if (preg_match($pattern, $condition, $matches, PREG_OFFSET_CAPTURE) == false &&
            preg_match($pattern, $key, $matches, PREG_OFFSET_CAPTURE) == false
        ) {
            $result = $this->more('usp_findManager', array("'$condition'", "N'$key'"));

            if (empty($result)) {
                $result = array();
            }
        } else {
            $result = array();
        }

        return $result;
    }

    /**
     * Get ID
     * @return bool|int
     */
    public function getId()
    {
        return $this->session('id');
    }

    /**
     * Get user name
     *
     * @return bool|string
     */
    public function getUsername()
    {
        return $this->session('user');
    }

    /**
     * Get full name
     *
     * @return bool|string
     */
    public function getName()
    {
        return $this->session('name');
    }

    /**
     * Get all managers
     *
     * @return \Application\System\matrix|null
     */
    public function getAll()
    {
        return $this->more('usp_findAllManager');
    }

    /**
     * Get Operator
     *
     * If user is Moderator, this function will return Operator ID
     *
     * @return string|null
     */
    public function getOperator()
    {
        return $this->session('operator');
    }


}