<?php 

require_once ('class/connection.class.php');

if (isset($_SESSION['luces_username'])) 
{
	$conn= new Connection();
	$conn->logout();
}


else
{
	header('Location: ../../index.php?error=true');	
}
	


	

 ?>