<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("db.class.php");


class  User extends Database
{

	function getBranches()
	{
		$sql = "SELECT * FROM branch";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $branches[] = array($row['id'], $row['name']);
						}

						return $branches;
					} 

					else 
					{
						return false;
					} 
				}
	}


	function getRoles()
	{
		$sql = "SELECT * FROM role";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $roles[] = array($row['id'], $row['name']);
						}

						return $roles;
					} 

					else 
					{
						return false;
					} 
				}
	}


	function addUser($name,$lastname,$identityCard,$email,$username,$password,$idRole,$idBranch)
	{
			$sql = "INSERT INTO user (name,lastName,identityCard,email,username,password,idRole,idBranch)
			VALUES('$name','$lastname','$identityCard','$email','$username',MD5('$password'),'$idRole','$idBranch')";

			$consulta = $this->conn->query($sql);

				if ($consulta)
				{
					return TRUE;
				} 

				else 
				{
					die(($this->conn->error));
				}	
	}




	function validateUsername($username)
	{
		$sql = "SELECT * FROM user";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						  if ($row['username']==$username) 
						  {
						  	return true;
						  }
						}

						
						return false;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function verifyIdentityCard ($identityCard)
	{
		$sql ="SELECT identityCard from user"; 

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						  if ($row['identityCard']==$identityCard) 
						  {
							return true;
						  }
						   
						}
						
						return false;
					} 

					
					else 
					{
						return false;
					} 
				}	
	}

	public function getUser($id_user,$id_branch)
	{
		$sql = "SELECT * FROM user where idBranch='$id_branch' and id='$id_user'";

		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
				   $user = array($row['id'], $row['name'],$row['lastName'],$row['identityCard'],$row['email'],$row['username'],$row['password'],$row['idBranch'],$row['idRole']);
				}

				return $user;
			} 

			else 
			{
				return false;
			} 
		}
	}

	public function getUsersList($id_branch)
	{
		$sql = "SELECT * FROM user where idBranch='$id_branch'";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $users[] = array($row['id'], $row['name'],$row['lastName'],$row['identityCard'],$row['username'],$row['idBranch']);
						}

						return $users;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function deleteUser($id)
	{
			$sql = "DELETE from user where id= '$id'";
			$consulta = $this->conn->query($sql);
			
			
			if($consulta)
			{
				return true;
			}

			else
			{
				die(($this->conn->error));
			}
	}


	public function changePassword($id,$new_password)
	{
		$sql="UPDATE user set password=MD5('$new_password') where id=$id";

			$consulta = $this->conn->query($sql);

				if ($consulta)
				{
					return TRUE;
				} 
				else 
				{
					die(($this->conn->error));
				}	
	}


	public function updateUser($id,$email,$username,$new_password,$idBranch,$idRole)
	{
		$sql="UPDATE user set email='$email',username='$username',password=MD5('$new_password'),idBranch='$idBranch',idRole='$idRole' where id=$id";


			$consulta = $this->conn->query($sql);

				if ($consulta)
				{
					return TRUE;
				} 
				else 
				{
					die(($this->conn->error));
				}	
	}

}