<?php
namespace model_app;
$con=mysqli_connect("127.0.0.1:3306","root","","test");
//$con=mysql_connect('127.0.0.1:3306', 'trung', '123456789');
//mysqli_query("SET NAMES 'utf8'");
$select=mysqli_query($con,"SELECT * FROM table_test");//tru v?n vao database dia chi

$select1=mysqli_query($con,"SELECT * FROM login_user");// truy van vao database user(hien chua co database)

$mang = array();

if(!empty($_GET['name'])&&!empty($_GET['password']))
{
    $usernew = new user("trung","01639548517",$select1);
    if($usernew->check==1)
    {
        echo "ok";
    }
}

if (!empty($_GET)) {
    $test = $_GET['test'];
}


while ($row= mysqli_fetch_array($select,MYSQLI_ASSOC))
{
    $ten        = $row["ten"];
    $longitude  = $row["longitude"];
    $latitude   = $row["latitude"];
    array_push($mang, new addr($ten, $longitude, $latitude));
}
if (!empty($test)) {
    if($test==1)
        echo json_encode($mang);
    else
        echo $test;
}

class addr{
    var $ten;
    var $longitude;
    var $latitude;
    function addr($ten, $longitude, $latitude){
        $this->ten = $ten;
        $this->longitude=$longitude;
        $this->latitude=$latitude;
    }
}
?>
