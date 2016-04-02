<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 3/31/2016
 * Time: 10:46 PM
 */
require_once('config.php');
require_once('loader.php');
require_once('const.php');
function insertAccount($username, $password)
{
    $db = loader::getInstance();
    $mysqli = $db->getConnection();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO account(username,password) VALUE ($username,$password)";
    if ($mysqli->query($sql)) {
        ResponseMessage(CODE_OK, STATUS_SUCCESS, '', null);
        return true;

    } else
        return false;
}

function login($username, $password)
{
    $db = loader::getInstance();
    $mysqli = $db->getConnection();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());

    }
    if (CheckUser($username, $password)) {
        $token = CreateToken(50);
        $sql = "SELECT * FROM account
						WHERE username = '$username'
						AND password = '$password'
						LIMIT 1";
        $result = $mysqli->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $sql1 = "UPDATE account SET token = '$token' WHERE username = '$username'";
            $res = $mysqli->query($sql1);
            if ($res) {
                $response = array();
                $row = mysql_fetch_assoc($res);
                while ($row) {
                    $response[USERNAME] = $row[USERNAME];
                    $response['token'] = $row[token];
                    ResponseMessage(CODE_OK, STATUS_SUCCESS, "", $response);
                }
                return true;
            } else
                return false;
        } else
            return false;
    } else
        return false;

}



function CheckUser($username, $password)
{
    // Create connection
    $db = loader::getInstance();
    $mysqli = $db->getConnection();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM account
						WHERE username = '$username'
						AND password = '$password'
						LIMIT 1";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else return false;
}

function ResponseMessage($code, $status, $message, $data)
{
    $arr = array('code' => $code, 'status' => $status, 'message' => $message, 'data' => $data);
    echo json_encode($arr);
}

function CreateToken($length)
{
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

?>