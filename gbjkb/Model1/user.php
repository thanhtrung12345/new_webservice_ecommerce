<?php
/**
 * Created by PhpStorm.
 * User: trung
 * Date: 31/03/2016
 * Time: 11:33 CH
 */

namespace model_app;


class user
{
    var $check;//bien kiem tra tinh hop le cua user
    var $name;
    var $password;
    function user($name, $pass, $select)
    {
        $this->name=$name;
        $this->password=$pass;
        $this->compare($select);
    }

    // hàm ki?m tra tính hop le cua user
    // select là bi?n chu gia tri select ðý?c t? mysql
    function compare($select)
    {
        while ($row= mysqli_fetch_array($select,MYSQLI_ASSOC))
        {
            if($this->name==$row['name']&&($this->password==$row['password']))//n?u user, pass hop l? th? dùng ki?m  tra
            {
                $this->check=1;
                break;
            }
            else
                $this->check=0;
        }
    }
}