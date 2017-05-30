<?php 
	
	
	class Database
	{
		private $db_host = "localhost";
		private $db_user = "luces249_admin";
		private $db_pass = "Luces123";
		private $db_name = "luces249_luces";
		protected $conn;


		function __construct()
		{
			$this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
			$acentos = $this->conn->query("SET NAMES 'utf8'");

			if ($this->conn->error) 
			{
				die("Ha ocurrido un error al establecer la conexion: error($this->conn->errno) $this->conn->error" );
			} 

		}



		function disconect()
		{
			mysqli_close();
		}


		function query($sql)
		{
			
			$query = $this->conn->query($sql);

			if ($query) 
			{
				if ($query->num_rows > 0) 
				{										
					return $query;
				}

				else
				{
					return false;
				}
			}
		}

}





?>