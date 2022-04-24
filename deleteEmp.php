<?php
	include ('connection.php');

	if(isset($_POST["id_emp"]))
	{
		foreach ($_POST["id_emp"] as $id_emp) 
		{
			$query="DELETE FROM employe where id_emp ='".$id_emp."'";
			mysqli_query($con,$query);	
		}
	}
?>