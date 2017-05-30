<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once ("db.class.php");


class  Connection extends Database
{

		public function login($username, $password)
		{
			$sql = "SELECT * FROM user WHERE username = '$username' AND password = MD5('$password') ";
			$result = $this->conn->query($sql);

			if ($result) 
			{
				if ($result->num_rows > 0) 
				{
					$row = $result->fetch_assoc();
					$_SESSION['luces_username'] = $row['username'];
					$_SESSION['password']=$row['password'];
					$_SESSION['id_user']=$row['id'];
					$_SESSION['id_role']=$row['idRole'];
					$_SESSION['name']=$row['name'];
					$_SESSION['id_branch']=$row['idBranch'];
					


					if ($_SESSION['id_role']==1) 
					{
						header('Location:../pages/home_manager.php');	
					}



					elseif ($_SESSION['id_role']==2) 
					{
						header('Location:../pages/home_employee.php');	
					}
					
				} 

				else 
				{
					session_destroy();
					header('Location: ../../index.php?error=true');	
				} 
			}
		}


		public function validate_session($role=2)
		{
			if (!isset($_SESSION['id_role']) || !isset($_SESSION['id_user']))
		    {    
		        header('Location: ../../index.php?error=true');
		    }

		    elseif ($_SESSION['id_role']!=1 && $_SESSION['id_role']!=$role)  
		    {        
		        header('Location: ../../index.php?error=true');
		    }

		    else
			include("../modules/sections/head.php");
		}


		public function logout()
		{
			session_destroy();
			header('Location: ../../index.php'); 
		}

}

  

 ?>