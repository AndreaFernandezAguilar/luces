<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/user.class.php");
$user= new User();

$id=$_REQUEST['idUser'];

if($user->deleteUser($id))
{
	echo  "1";
}
else
{
	echo  "0";
}

?>