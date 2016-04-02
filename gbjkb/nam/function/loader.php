<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 3/31/2016
 * Time: 10:47 PM
 */
require_once('config.php');

class loader
{
    private $_connection;
    private static $_instance; //The single instance
//    private $_host = "mysql.hostinger.vn";
//    private $_username = "u213148218_cuoi";
//    private $_password = "26120710";
//    private $_database = "u213148218_hotel";
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }


    private function __construct()
    {
        $this->_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }


    private function __clone()
    {
    }


    public function getConnection()
    {
        return $this->_connection;
    }
}

?>