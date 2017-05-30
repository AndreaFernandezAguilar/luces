<?php 

	require ('class/connection.class.php');

	$conn= new Connection();
    $conn->login($_REQUEST['username'],$_REQUEST['password']);


 ?>