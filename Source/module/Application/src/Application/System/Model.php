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

/**
 *  Model
 *
 * Configuring Database Activity
 *
 * @category   VeXeCuaTui Project
 * @package    Application\Model
 * @author     Nam Vo <vhnam2504@gmail.com>
 * @copyright  Never Give Up Team
 * @license    Education
 */
abstract class Model extends App
{
    /**
     * Execute Stored Procedure
     *
     * @example $user->non('usp_insert', array("'1264789'", "N'Hoy Mặt Ngu'", "'2000-05-06'", "9.6"))
     * @example $user->non('usp_load')
     *
     * @param string $sp Stored procedure name
     * @param array|null $parameters Parameters of Stored Procedure
     * @return bool
     * @throws \Exception SqlException
     */
    public function non($sp, $parameters = null)
    {
        // Initialize query string
        $sql = '{call ' . $sp;

        if ($parameters) {
            $sql .= ' (';

            foreach ($parameters as $parameter) {
                $sql .=  $parameter . ',';
            }

            $sql = substr($sql, 0, -1) . ')';
        }

        $sql .= '}';

        // Execute query
        $options = array('Database' => Config::db_database, 'CharacterSet' => 'UTF-8');
        $connection = sqlsrv_connect(Config::db_server, $options);
        $result = sqlsrv_query($connection, $sql);

        if ($result == false) {
            $err =  sqlsrv_errors();
            sqlsrv_close($connection);
            throw new CustomException($err[0]['message']);
        }

        // Free the statement and connection resources
        sqlsrv_free_stmt($result);
        sqlsrv_close($connection);
    }

    /**
     * Execute Function and get one value
     *
     * @example $user->one('uf_getName', array("'1265104'"))
     * @example $user->one('uf_nonParam')
     *
     * @param string $func Name of Function
     * @param array|null $parameters Parameters of Function
     * @return object|bool|null
     *
     */
    public function one($func, $parameters = null)
    {
        // Initialize query string
        $sql = 'select dbo.' . $func;

        if ($parameters) {
            $sql .= ' (';

            foreach ($parameters as $parameter) {
                $sql .=  $parameter . ',';
            }

            $sql = substr($sql, 0, -1) . ')';
        } else {
            $sql .= '()';
        }

        // Execute Query
        $options = array('Database' => Config::db_database, 'CharacterSet' => 'UTF-8');
        $connection = sqlsrv_connect(Config::db_server, $options) or die("Couldn't connect to SQL Server");
        $value = sqlsrv_query($connection, $sql);

        // Check Result
        $result = false;

        if ($value) {
            $result = sqlsrv_fetch_array($value);
        }

        // Free the statement and connection resources
        sqlsrv_free_stmt($value);
        sqlsrv_close($connection);

        // Return result
        if ($parameters) {
            return $result;
        }

        return $result[0];
    }

    /**
     * Execute Stored Procedure and get more values
     *
     * @example $user->more('usp_withParam', array("'1265113'"))
     * @example $user->more('usp_nonParam')
     *
     * @param string $sp Stored Procedure Name
     * @param array|null $parameters Parameters of Stored Procedure
     * @return matrix|null
     *
     */
    public function more($sp, $parameters = null)
    {
        // Initialize query string
        $sql = '{call ' . $sp;

        if ($parameters) {
            $sql .= ' (';

            foreach ($parameters as $parameter) {
                $sql .=  $parameter . ',';
            }

            $sql = substr($sql, 0, -1) . ')';
        }

        $sql .= '}';

        // Execute query
        $options = array('Database' => Config::db_database, 'CharacterSet' => 'UTF-8');
        $connection = sqlsrv_connect(Config::db_server, $options) or die("Couldn't connect to SQL Server");
        $data = sqlsrv_query($connection, $sql);

        $result = false;

        // Fetch data into array
        if ($data !== false) {
            $result = array();

            while ($row = sqlsrv_fetch_array($data)) {
                array_push($result, $row);
            }

            // Free the statement
            sqlsrv_free_stmt($data);
        }

        // Free connection resources
        sqlsrv_close($connection);

        // Return an array
        return $result;
    }
}