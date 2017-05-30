<?php 

require_once ("db.class.php");
session_start();

class test extends Connection
{
	public function login($username, $password)
		{
			$sql = "SELECT * FROM user WHERE name = '$username' AND password = MD5('$password') ";
			$result = $this->conn->query($sql);

			if ($result) 
			{

				if ($result->num_rows > 0) 
				{
					$row = $result->fetch_assoc();
					$_SESSION['username'] = $row['name'];
					$_SESSION['password']=$row['password'];

					
						header('Location: dashboard-administrador.php');
				
				} 


				else 
				{
					session_destroy();
					header('Location: ../../login.php?error=true');
					
				} 
			}
		}

}



$connection= new Connection ();
/*$result="SELECT *from machine";
$test=$connection->query($result);*/


/*if ($test->num_rows > 0) 
	{
		while ($fila = mysqli_fetch_assoc($test)) 
		{
			echo "maquina:". $fila['name']."<br>";
		}

		//return $diplo;
	} */


 ?>